<?php

use App\Http\Controllers\MenuManagementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\UserManagementController;
use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');

    return "Cache cleared successfully";
});
Route::get('/optimize', function () {
    Artisan::call('optimize');

    return "Optimized successfully";
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //Middleware Permission
    Route::middleware([CheckPermission::class])->group(function () {

        //Profile generated by Breeze
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/posts', function () {
            return view('dashboard2');
        })->name('posts.index');

        Route::resource('/users', UserManagementController::class);
        Route::resource('/menus', MenuManagementController::class);
        Route::resource('/roles', RoleManagementController::class);
        Route::resource('/permissions', PermissionController::class);
    });

    // Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/dashboard2', function () {
        return view('dashboard2');
    });
});


require __DIR__ . '/auth.php';
