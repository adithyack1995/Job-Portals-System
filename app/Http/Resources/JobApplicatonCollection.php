<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobApplicatonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($jobApplication) {
            return [
                'id' => $jobApplication->id,
                'job_post_id' => $jobApplication->jobPost->id,
                'job_post_name' => $jobApplication->jobPost->title,
                'applicant_id' => $jobApplication->applicant->id,
                'applicant_name' => $jobApplication->applicant->fullName,
                'cover_letter' => $jobApplication->cover_letter,
                'status' => $jobApplication->status,
            ];
        });
    }
}
