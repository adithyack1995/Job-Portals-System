<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicatonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'job_post_id' => $this->jobPost->id,
            'job_post_name' => $this->jobPost->title,
            'job_post_description' => $this->jobPost->description,
            'job_post_company_name' => $this->jobPost->company_name,
            'job_post_location' => $this->jobPost->location,
            'job_post_salary' => $this->jobPost->salary ,
            'applicant_id' => $this->applicant->id,
            'applicant_name' => $this->applicant->fullName,
            'cover_letter' => $this->cover_letter,
            'status' => $this->status,
        ];
    }
}
