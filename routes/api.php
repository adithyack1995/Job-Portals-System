<?php

use App\Http\Controllers\api\v1\admin\JobApplicationController as AdminJobApplicationController;
use App\Http\Controllers\api\v1\admin\JobController;
use App\Http\Controllers\api\v1\admin\LoginController as AdminLoginController;
use App\Http\Controllers\api\v1\admin\UserController;
use App\Http\Controllers\api\v1\JobApplicationController;
use App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index'])->name('admin.job.index');
        Route::get('/{jobPost}', [JobController::class, 'show'])->name('admin.job.show');
    });
    Route::prefix('user')->group(function () {
        Route::post('/register', [RegisterController::class, 'store'])->name('user.register');
        Route::get('/verify/{token}/{email}', [RegisterController::class, 'verify'])->name('user.verify');
        Route::post('/login', [LoginController::class, 'login'])->name('user.login');
        Route::middleware('auth:api')->group(function () {
            Route::prefix('job-application')->group(function () {
                Route::post('/', JobApplicationController::class)->name('user.job.apply');
            });
            Route::post('/logout', [AdminLoginController::class, 'logout']);
        });
    });
    Route::prefix('admin')->group(function () {
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
        Route::middleware('auth:api')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('admin.users.list');
                Route::get('/{user}', [UserController::class, 'show'])->name('admin.users.show');
            });
            Route::prefix('jobs')->group(function () {
                Route::post('/', [JobController::class, 'store'])->name('admin.job.store');
                Route::put('/{jobPost}', [JobController::class, 'update'])->name('admin.job.update');
                Route::delete('/{jobPost}', [JobController::class, 'destroy'])->name('admin.job.delete');
            });
            Route::prefix('job-application')->group(function () {
                Route::get('/', [AdminJobApplicationController::class, 'index'])->name('admin.job.application.list');
                Route::get('/{jobApplication}', [AdminJobApplicationController::class, 'show'])->name('admin.job.application.show');
                Route::delete('/{jobApplication}', [AdminJobApplicationController::class, 'destroy'])->name('admin.job.application.destroy');
            });
            Route::post('/logout', [AdminLoginController::class, 'logout']);
        });
    });
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
