<?php

use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => 'student_check'], function () {
        Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
        Route::middleware('student_null')->group(function () {
            Route::resource('student', StudentController::class)->except(['index', 'create']);
        });
    });

    // admin
    Route::group(['prefix' => 'admin','middleware' => 'admin_check'], function() {
        // Route::get('/dashboard', function () {
        //     return Inertia::render('DashboardAdmin');
        // });
        Route::get('teacher', [AdminTeacherController::class, 'index'])->name('teacher.index');
        Route::get('teacher/new', [AdminTeacherController::class, 'create'])->name('teacher.create');
        Route::post('teacher', [AdminTeacherController::class, 'store'])->name('teacher.store');
        
        // Route::get('teacher/import', [AdminImportController::class, 'import'])->name('file.create');
        // Route::post('teacher/import', [AdminImportController::class, 'store'])->name('file.store');
    });

});

require __DIR__.'/auth.php';
