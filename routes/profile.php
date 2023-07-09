<?php

use App\Http\Controllers\Frontend\my\campaigns\MyCampaignController;
use App\Http\Controllers\Frontend\my\donations\MyDonationController;
use App\Http\Controllers\Frontend\my\paymentGateways\MyPublicUserPaymentGatewayController;
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
    Route::get('/campaigns/{id}/edit', [MyCampaignController::class, 'edit'])->name('my.campaigns.edit');
    Route::get('/campaigns/{id}/view', [MyCampaignController::class, 'view'])->name('my.campaigns.view');
    Route::put('/campaigns/{id}', [MyCampaignController::class, 'update'])->name('my.campaigns.update');
    Route::get('/campaigns/create', [MyCampaignController::class, 'create'])->name('my.campaigns.create');
    Route::post('/campaigns', [MyCampaignController::class, 'store'])->name('my.campaigns.store');
    Route::get('/campaigns-delete', [MyCampaignController::class, 'delete'])->name('my.campaigns.delete');
    /* END CAMPAIGNS */

    /* CAMPAIGNS */
    Route::get('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'index'])->name('my.payment.gateways.list');
    Route::get('/payment-gateways/{id}/edit', [MyPublicUserPaymentGatewayController::class, 'edit'])->name('my.payment.gateways.edit');
    Route::get('/payment-gateways/{id}/view', [MyPublicUserPaymentGatewayController::class, 'view'])->name('my.payment.gateways.view');
    Route::put('/payment-gateways/{id}', [MyPublicUserPaymentGatewayController::class, 'update'])->name('my.payment.gateways.update');
    Route::get('/payment-gateways/create', [MyPublicUserPaymentGatewayController::class, 'create'])->name('my.payment.gateways.create');
    Route::post('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'store'])->name('my.payment.gateways.store');
    Route::get('/payment-gateways-delete', [MyPublicUserPaymentGatewayController::class, 'delete'])->name('my.payment.gateways.delete');
    /* END CAMPAIGNS */


    /* DONATIONS */
    Route::prefix('donations')->group(function () {
        Route::get('/', [MyDonationController::class, 'index'])->name('my.donations.list');
        Route::get('/{id}/edit', [MyDonationController::class, 'edit'])->name('my.donations.edit');
        Route::get('/{id}/view', [MyDonationController::class, 'view'])->name('my.donations.view');
        Route::put('/{id}', [MyDonationController::class, 'update'])->name('my.donations.update');
        Route::get('create', [MyDonationController::class, 'create'])->name('my.donations.create');
        Route::post('/', [MyDonationController::class, 'store'])->name('my.donations.store');
        Route::get('/payment-gateways-delete', [MyDonationController::class, 'delete'])->name('my.donations.delete');
    });
    /* END DONATIONS */
});
