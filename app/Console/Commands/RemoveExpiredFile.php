<?php

namespace App\Console\Commands;

use App\Models\UserFile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveExpiredFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:remove-expired-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove files that have expired.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileExpires = config('variables.file_expires');
        $startDate = Carbon::now()->subDays($fileExpires);
        $files = UserFile::where('created_at', '<', $startDate)->get();
        foreach ($files as $file) {
            $filePath = $file->file_path;
            if (Storage::exists($filePath)) {
                // Delete the file
                Storage::delete($filePath);
            }
            $file->delete();
        }
    }
}
