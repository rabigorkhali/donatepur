<?php

use App\Http\Controllers\Frontend\mysuperuser\campaigns\MyCampaignController;
use App\Http\Controllers\Frontend\mysuperuser\donations\MyDonationController;
use App\Http\Controllers\Frontend\mysuperuser\donations\MyDonationReceivedController;
use App\Http\Controllers\Frontend\mysuperuser\MyDashboardController;
use App\Http\Controllers\Frontend\mysuperuser\paymentGateways\MyPublicUserPaymentGatewayController;
use App\Http\Controllers\Frontend\mysuperuser\withdrawals\MyWithdrawalsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['frontend_users'])->name('mysuperuser.dashboard');



Route::prefix('mysuperuser')->middleware('frontend_users_super')->group(function () {
    Route::get('', [MyDashboardController::class, 'index'])->name('mysuperuser.dashboard');
    Route::get('/dashboard', [MyDashboardController::class, 'index'])->name('mysuperuser.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('mysuperuser.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('mysuperuser.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('mysuperuser.profile.destroy');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('mysuperuser.profile.logout');

    /* CAMPAIGNS */
    Route::get('/campaigns', [MyCampaignController::class, 'index'])->name('mysuperuser.campaigns.list');
    Route::get('/campaigns/{id}/edit', [MyCampaignController::class, 'edit'])->name('mysuperuser.campaigns.edit');
    Route::get('/campaigns/{id}/view', [MyCampaignController::class, 'view'])->name('mysuperuser.campaigns.view');
    Route::put('/campaigns/{id}', [MyCampaignController::class, 'update'])->name('mysuperuser.campaigns.update');
    Route::get('/campaigns/create', [MyCampaignController::class, 'create'])->name('mysuperuser.campaigns.create');
    Route::post('/campaigns', [MyCampaignController::class, 'store'])->name('mysuperuser.campaigns.store');
    Route::get('/campaigns-delete', [MyCampaignController::class, 'delete'])->name('mysuperuser.campaigns.delete');
    Route::get('/campaigns-summary/{id}', [MyCampaignController::class, 'campaignSummary'])->name('mysuperuser.campaigns.campaignSummary');
    /* END CAMPAIGNS */

    /* PAYMENT GATEWAYS */
    Route::get('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'index'])->name('mysuperuser.payment.gateways.list');
    Route::get('/payment-gateways/{id}/edit', [MyPublicUserPaymentGatewayController::class, 'edit'])->name('mysuperuser.payment.gateways.edit');
    Route::get('/payment-gateways/{id}/view', [MyPublicUserPaymentGatewayController::class, 'view'])->name('mysuperuser.payment.gateways.view');
    Route::put('/payment-gateways/{id}', [MyPublicUserPaymentGatewayController::class, 'update'])->name('mysuperuser.payment.gateways.update');
    Route::get('/payment-gateways/create', [MyPublicUserPaymentGatewayController::class, 'create'])->name('mysuperuser.payment.gateways.create');
    Route::post('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'store'])->name('mysuperuser.payment.gateways.store');
    Route::get('/payment-gateways-delete', [MyPublicUserPaymentGatewayController::class, 'delete'])->name('mysuperuser.payment.gateways.delete');
    /* END PAYMENT GATEWAYS */


    /* DONATIONS */
    Route::prefix('donations')->group(function () {
        Route::get('/', [MyDonationController::class, 'index'])->name('mysuperuser.donations.list');
        Route::get('/{id}/view', [MyDonationController::class, 'view'])->name('mysuperuser.donations.view');
    });
    /* END DONATIONS */

    /* DONATIONS */
    Route::prefix('donations-received')->group(function () {
        Route::get('/', [MyDonationReceivedController::class, 'index'])->name('mysuperuser.donations.received.list');
        Route::get('/{id}/view', [MyDonationReceivedController::class, 'view'])->name('mysuperuser.donations.received.view');
    });
    /* END DONATIONS */

    /* WITHDRAWALS */
    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [MyWithdrawalsController::class, 'index'])->name('mysuperuser.withdrawals.list');
        Route::get('/{id}/edit', [MyWithdrawalsController::class, 'edit'])->name('mysuperuser.withdrawals.edit');
        Route::get('/{id}/view', [MyWithdrawalsController::class, 'view'])->name('mysuperuser.withdrawals.view');
        Route::put('/{id}', [MyWithdrawalsController::class, 'update'])->name('mysuperuser.withdrawals.update');
        Route::get('/create', [MyWithdrawalsController::class, 'create'])->name('mysuperuser.withdrawals.create');
        Route::post('/', [MyWithdrawalsController::class, 'store'])->name('mysuperuser.withdrawals.store');
        Route::get('/payment-gateways-delete', [MyWithdrawalsController::class, 'delete'])->name('mysuperuser.withdrawals.delete');
    });
    /* END WITHDRAWALS */
});
