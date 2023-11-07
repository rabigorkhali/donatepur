<?php

use App\Http\Controllers\Frontend\my\campaigns\MyCampaignController;
use App\Http\Controllers\Frontend\my\donations\MyDonationController;
use App\Http\Controllers\Frontend\my\donations\MyDonationReceivedController;
use App\Http\Controllers\Frontend\my\MyDashboardController;
use App\Http\Controllers\Frontend\my\paymentGateways\MyPublicUserPaymentGatewayController;
use App\Http\Controllers\Frontend\my\withdrawals\MyWithdrawalsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['frontend_users'])->name('dashboard');



Route::prefix('my')->middleware(['frontend_users','throttle:100,1'])->group(function () {
    Route::get('/dashboard', [MyDashboardController::class, 'index'])->name('my.dashboard');
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
    Route::get('/campaigns-summary/{id}', [MyCampaignController::class, 'campaignSummary'])->name('my.campaigns.campaignSummary');
    /* END CAMPAIGNS */

    /* PAYMENT GATEWAYS */
    Route::get('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'index'])->name('my.payment.gateways.list');
    Route::get('/payment-gateways/{id}/edit', [MyPublicUserPaymentGatewayController::class, 'edit'])->name('my.payment.gateways.edit');
    Route::get('/payment-gateways/{id}/view', [MyPublicUserPaymentGatewayController::class, 'view'])->name('my.payment.gateways.view');
    Route::put('/payment-gateways/{id}', [MyPublicUserPaymentGatewayController::class, 'update'])->name('my.payment.gateways.update');
    Route::get('/payment-gateways/create', [MyPublicUserPaymentGatewayController::class, 'create'])->name('my.payment.gateways.create');
    Route::post('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'store'])->name('my.payment.gateways.store');
    Route::get('/payment-gateways-delete', [MyPublicUserPaymentGatewayController::class, 'delete'])->name('my.payment.gateways.delete');
    /* END PAYMENT GATEWAYS */


    /* DONATIONS */
    Route::prefix('donations')->group(function () {
        Route::get('/', [MyDonationController::class, 'index'])->name('my.donations.list');
        Route::get('/{id}/view', [MyDonationController::class, 'view'])->name('my.donations.view');
    });
    /* END DONATIONS */

    /* DONATIONS */
    Route::prefix('donations-received')->group(function () {
        Route::get('/', [MyDonationReceivedController::class, 'index'])->name('my.donations.received.list');
        Route::get('/{id}/view', [MyDonationReceivedController::class, 'view'])->name('my.donations.received.view');
    });
    /* END DONATIONS */

    /* WITHDRAWALS */
    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [MyWithdrawalsController::class, 'index'])->name('my.withdrawals.list');
        Route::get('/{id}/edit', [MyWithdrawalsController::class, 'edit'])->name('my.withdrawals.edit');
        Route::get('/{id}/view', [MyWithdrawalsController::class, 'view'])->name('my.withdrawals.view');
        Route::put('/{id}', [MyWithdrawalsController::class, 'update'])->name('my.withdrawals.update');
        Route::get('/create', [MyWithdrawalsController::class, 'create'])->name('my.withdrawals.create');
        Route::post('/', [MyWithdrawalsController::class, 'store'])->name('my.withdrawals.store');
        Route::get('/payment-gateways-delete', [MyWithdrawalsController::class, 'delete'])->name('my.withdrawals.delete');
    });
    /* END WITHDRAWALS */
});
