<?php

use App\Http\Controllers\Frontend\my\campaigns\MyCampaignController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['frontend_users', 'verified'])->name('dashboard');

Route::prefix('my')->middleware('frontend_users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');

    /* CAMPAIGNS */
    Route::get('/campaigns', [MyCampaignController::class, 'index'])->name('my.campaigns.list');
    Route::get('/campaigns/{id}', [MyCampaignController::class, 'edit'])->name('my.campaigns.edit');
    Route::put('/campaigns/{id}', [MyCampaignController::class, 'update'])->name('my.campaigns.update');
    /* END CAMPAIGNS */
});
