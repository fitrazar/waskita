<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\ContactController as GeneralContactController;
use App\Http\Controllers\QuizController as GeneralQuizController;
use App\Http\Controllers\VideoController as GeneralVideoController;
use App\Http\Controllers\MaterialController as GeneralMaterialController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/material/{material}', [GeneralMaterialController::class, 'show'])->name('dashboard');
Route::get('/materials', [DashboardController::class, 'fetchMaterials'])->name('materials.fetch');
Route::get('/videos', [DashboardController::class, 'fetchVideos'])->name('videos.fetch');
Route::get('/search', action: [DashboardController::class, 'search'])->name('search');
Route::get('/material', [GeneralMaterialController::class, 'index'])->name('material');
Route::get('/video', [GeneralVideoController::class, 'index'])->name('video');
Route::get('/quiz', [GeneralQuizController::class, 'index'])->name('quiz');
Route::get('/contact', [GeneralContactController::class, 'index'])->name('contact');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('/material', MaterialController::class)->except('show');
    Route::resource('/video', VideoController::class)->except('show');
    Route::resource('/quiz', QuizController::class)->except('show');


    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

require __DIR__ . '/auth.php';
