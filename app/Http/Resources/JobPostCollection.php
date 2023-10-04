<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class JobPostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($jobPost) {
            return [
                'id' => $jobPost->id,
                'title' => $jobPost->title,
                'description' => $jobPost->description,
                'company_name' => $jobPost->company_name,
                'location' => $jobPost->location,
                'salary' => $jobPost->salary,
                'closing_date' => $jobPost->closing_date,
                'is_active' => $jobPost->is_active,
            ];
        });
    }
}
