<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPostRequest;
use App\Http\Resources\JobPostCollection;
use App\Http\Resources\JobPostResource;
use App\Models\JobPost;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jobPosts = JobPost::latest('created_at');
            return ResponseHelper::success(new JobPostCollection($jobPosts->paginate(config('variables.page_per'))->withQueryString()));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        $this->authorize('create', JobPost::class);
        try {
            $data = $request->validated();
            $data['closing_date'] = Carbon::parse($request->closing_date)->format('Y-m-d');
            $jobPost = JobPost::create($data);
            return ResponseHelper::success(new JobPostResource($jobPost));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        return ResponseHelper::success(new JobPostResource($jobPost));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $jobPost)
    {
        $this->authorize('update', $jobPost);
        try {
            $data = $request->validated();
            $data['closing_date'] = ($request->closing_date ) ? Carbon::parse($request->closing_date)->format('Y-m-d') : null;
            $jobPost->update($data);
            return ResponseHelper::success(new JobPostResource($jobPost));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        $this->authorize('delete', $jobPost);
        try {
            $jobPost->delete();
            return ResponseHelper::successWithMessage(__('job.jobDeleteSuccess'));
        } catch (Exception $e) {
            return ResponseHelper::errorWithStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
