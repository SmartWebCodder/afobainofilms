<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Models\Testimonial;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'testimonials' => Testimonial::active()->orderBy('sort_order')->get(),
    ]);
})->name('home');
Route::get('/portfolio', fn() => Inertia::render('Portfolio', [
    'projects' => Project::published()->orderBy('sort_order')->get(),
]))->name('portfolio');
Route::get('/about', fn() => Inertia::render('About'))->name('about');
Route::get('/services', fn() => Inertia::render('Services'))->name('services');
Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::get('/', DashboardController::class)->name('admin.dashboard');

        Route::resource('projects', ProjectController::class)
            ->except(['show'])
            ->names('admin.projects');

        Route::resource('testimonials', TestimonialController::class)
            ->except(['show'])
            ->names('admin.testimonials');

        Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('admin.messages.show');
        Route::patch('/messages/{message}/status', [MessageController::class, 'updateStatus'])->name('admin.messages.status');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
        Route::put('/settings/site', [SettingController::class, 'updateSite'])->name('admin.settings.site');
        Route::put('/settings/profile', [SettingController::class, 'updateProfile'])->name('admin.settings.profile');
    });
});
