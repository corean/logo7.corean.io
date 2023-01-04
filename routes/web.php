<?php

use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
})->name('landing');

Route::get('/test', function () {
    return Inertia::render('Test');
})->name('test');
Route::get('/default-layout', function () {
    return Inertia::render('DefaultLayout');
})->name('default-layout');

Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/tabler', function () {
    return view('tabler');
})->name('tabler');

Route::get('/toast', [\App\Http\Controllers\TestController::class, 'toast'])->name('toast');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('super-admin')
        ->prefix('admin')
        ->as('admin.')
        ->group(function () {
            // 연간회원
            Route::get('memberships/{membership?}', [MembershipController::class, 'index'])->name('memberships.index');
            Route::put('memberships/{membership}', [MembershipController::class, 'update'])->name('memberships.update');
            Route::put('memberships/{membership}/confirm',
                [MembershipController::class, 'confirm'])->name('memberships.confirm');
            Route::put('memberships/{membership}/confirm-cancel',
                [MembershipController::class, 'confirmCancel'])->name('memberships.confirm-cancel');
            Route::delete('memberships', [MembershipController::class, 'destroy']);
        });
});

require __DIR__.'/auth.php';
