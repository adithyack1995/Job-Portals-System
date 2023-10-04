<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobApplicatonCollection;
use App\Http\Resources\JobApplicatonResource;
use App\Models\JobApplication;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', JobApplication::class);
        try {
            $jobApplications = JobApplication::latest('created_at');
            return ResponseHelper::success(new JobApplicatonCollection($jobApplications->paginate(config('variables.page_per'))->withQueryString()));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        $this->authorize('view', $jobApplication);
        try {
            return ResponseHelper::success(new JobApplicatonResource($jobApplication));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $this->authorize('delete', $jobApplication);
        try {
            $jobApplication->delete();
            return ResponseHelper::successWithMessage(__('job.jobApplicationSuccess'));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
