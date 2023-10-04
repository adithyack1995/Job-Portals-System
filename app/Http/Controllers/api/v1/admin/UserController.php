<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        try {
            $users = User::jobSeekers()->latest('created_at');
            return ResponseHelper::success(UserResource::collection($users->paginate(config('variables.page_per'))->withQueryString()));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        try {
            return ResponseHelper::success(new UserResource($user->load('userFile')));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
