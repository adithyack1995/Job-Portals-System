<?php

namespace App\Http\Controllers\api\v1;

use App\Events\JobApplicationEvent;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplicationRequest;
use App\Models\JobApplication;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(JobApplicationRequest $request)
    {
        $this->authorize('create', JobApplication::class);
        try {
            $data = $request->validated();
            $data['applicant_id'] = Auth::user()->id;
            $jobApplication = JobApplication::create($data);
            // Trigger the event
            event(new JobApplicationEvent(auth()->user()));
            return ResponseHelper::successWithMessage(__('job.success'));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
