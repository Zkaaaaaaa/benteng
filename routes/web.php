<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RamesController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SiteSettingNLController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Client Routes ──────────────────────────────────────
Route::get('/', [HomeController::class, 'indexNL'])->name('client.index-nl');
Route::get('/en', [HomeController::class, 'index'])->name('client.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('client.contact');

// ── Redirect Breeze dashboard → Admin ──────────────────
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Admin Routes ───────────────────────────────────────
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')        // <-- ini sudah otomatis prefix semua nama route
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Jangan pakai ->names() lagi, sudah ditangani ->name('admin.') di atas
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::get('rames/edit', [RamesController::class, 'edit'])->name('rames.edit');
        Route::put('rames/settings', [RamesController::class, 'updateSettings'])->name('rames.settings.update');
        Route::post('rames/items', [RamesController::class, 'storeItem'])->name('rames.items.store');
        Route::delete('rames/items/{ramesItem}', [RamesController::class, 'destroyItem'])->name('rames.items.destroy');
        Route::get('site-settings/edit', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
        Route::get('site-settings-nl/edit', [SiteSettingNLController::class, 'edit'])->name('site-settings-nl.edit');
        Route::put('site-settings-nl', [SiteSettingNLController::class, 'update'])->name('site-settings-nl.update');
    });

// ── Profile Routes ─────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
