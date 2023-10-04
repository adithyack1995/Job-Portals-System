<?php

namespace App\Http\Controllers\api\v1;

use App\Constants\UserType;
use App\Events\UserRegistered;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserFile;
use App\Notifications\VerifyEmailNotification;
use App\Repositories\FileRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        try {
            $data  = $request->validated();
            $data['password'] = Hash::make($request->password);
            $data['remember_token'] = Str::random(64);;
            $user = User::create($data);
            $user->assignRole(UserType::JOBSEEKER);
            //resume upload
            if ($request->hasFile('file_path')) {
                $details = $this->fileRepository->resumeUpload($request->file('file_path'));
            }
            $details['user_id'] = $user->id;
            UserFile::create($details);
            //mail functinality details(verify email)-integrated mailhog to handke email
            event(new UserRegistered($user));
            return ResponseHelper::success(new UserResource($user));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * To verify the registration link token is valid or not and verify the account.
     */
    public function verify($token, $email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($token == $user->remember_token) {
                if ($user->is_email_verified == false) {
                    $user->update(['is_email_verified' => true]);
                    return ResponseHelper::successWithMessageAndStatus(__('common.emailVerfied'), Response::HTTP_OK);
                }
                return ResponseHelper::errorWithMessageAndStatus(__('common.alreday verified'), Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                return ResponseHelper::errorWithMessageAndStatus(__('common.invalid token'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        return ResponseHelper::errorWithMessageAndStatus(__('common.notValidEmail'), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
