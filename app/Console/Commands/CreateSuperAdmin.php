<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a admin';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = User::role('admin')->count();

        if (!$user) {
            User::factory()->createQuietly([
                'name' => 'Admin',
                'email' => 'admin@jobportals.com',
                'password' => Hash::make('jobportal@123'),
            ])->assignRole('admin');


            $this->info("SUCCESS, Admin created.");
        } else {
            $this->info("SUCCESS, Admin already exist.");
        }
    }
}

