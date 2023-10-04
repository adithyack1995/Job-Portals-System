<?php

namespace App\Repositories;

use App\Constants\ImageSize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileRepository
{

  public function resumeUpload($resume)
  {
    $details['file_path'] = $resume->store('resume');
    $details['filename'] = $resume->getClientOriginalName();
    return $details;
  }

}
