<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Portuguese Routes (default)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projetos', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/contato', [ContactController::class, 'store'])->middleware('throttle:5,10')->name('contact.store');

// English Routes
Route::prefix('en')->name('en.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,10')->name('contact.store');
});

Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');
