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
// })->middleware(['frontend_users'])->name('my.superuser.dashboard');



Route::prefix('mysuperuser')->middleware('frontend_users_super')->group(function () {
    Route::get('', [MyDashboardController::class, 'index'])->name('my.superuser.my.dashboard');
    Route::get('/dashboard', [MyDashboardController::class, 'index'])->name('my.superuser.my.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('my.superuser.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('my.superuser.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('my.superuser.profile.destroy');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('my.superuser.profile.logout');

    /* CAMPAIGNS */
    Route::get('/campaigns', [MyCampaignController::class, 'index'])->name('my.superuser.my.campaigns.list');
    Route::get('/campaigns/{id}/edit', [MyCampaignController::class, 'edit'])->name('my.superuser.my.campaigns.edit');
    Route::get('/campaigns/{id}/view', [MyCampaignController::class, 'view'])->name('my.superuser.my.campaigns.view');
    Route::put('/campaigns/{id}', [MyCampaignController::class, 'update'])->name('my.superuser.my.campaigns.update');
    Route::get('/campaigns/create', [MyCampaignController::class, 'create'])->name('my.superuser.my.campaigns.create');
    Route::post('/campaigns', [MyCampaignController::class, 'store'])->name('my.superuser.my.campaigns.store');
    Route::get('/campaigns-delete', [MyCampaignController::class, 'delete'])->name('my.superuser.my.campaigns.delete');
    Route::get('/campaigns-summary/{id}', [MyCampaignController::class, 'campaignSummary'])->name('my.superuser.my.campaigns.campaignSummary');
    /* END CAMPAIGNS */

    /* PAYMENT GATEWAYS */
    Route::get('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'index'])->name('my.superuser.my.payment.gateways.list');
    Route::get('/payment-gateways/{id}/edit', [MyPublicUserPaymentGatewayController::class, 'edit'])->name('my.superuser.my.payment.gateways.edit');
    Route::get('/payment-gateways/{id}/view', [MyPublicUserPaymentGatewayController::class, 'view'])->name('my.superuser.my.payment.gateways.view');
    Route::put('/payment-gateways/{id}', [MyPublicUserPaymentGatewayController::class, 'update'])->name('my.superuser.my.payment.gateways.update');
    Route::get('/payment-gateways/create', [MyPublicUserPaymentGatewayController::class, 'create'])->name('my.superuser.my.payment.gateways.create');
    Route::post('/payment-gateways', [MyPublicUserPaymentGatewayController::class, 'store'])->name('my.superuser.my.payment.gateways.store');
    Route::get('/payment-gateways-delete', [MyPublicUserPaymentGatewayController::class, 'delete'])->name('my.superuser.my.payment.gateways.delete');
    /* END PAYMENT GATEWAYS */


    /* DONATIONS */
    Route::prefix('donations')->group(function () {
        Route::get('/', [MyDonationController::class, 'index'])->name('my.superuser.my.donations.list');
        Route::get('/{id}/view', [MyDonationController::class, 'view'])->name('my.superuser.my.donations.view');
    });
    /* END DONATIONS */

    /* DONATIONS */
    Route::prefix('donations-received')->group(function () {
        Route::get('/', [MyDonationReceivedController::class, 'index'])->name('my.superuser.my.donations.received.list');
        Route::get('/{id}/view', [MyDonationReceivedController::class, 'view'])->name('my.superuser.my.donations.received.view');
    });
    /* END DONATIONS */

    /* WITHDRAWALS */
    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [MyWithdrawalsController::class, 'index'])->name('my.superuser.my.withdrawals.list');
        Route::get('/{id}/edit', [MyWithdrawalsController::class, 'edit'])->name('my.superuser.my.withdrawals.edit');
        Route::get('/{id}/view', [MyWithdrawalsController::class, 'view'])->name('my.superuser.my.withdrawals.view');
        Route::put('/{id}', [MyWithdrawalsController::class, 'update'])->name('my.superuser.my.withdrawals.update');
        Route::get('/create', [MyWithdrawalsController::class, 'create'])->name('my.superuser.my.withdrawals.create');
        Route::post('/', [MyWithdrawalsController::class, 'store'])->name('my.superuser.my.withdrawals.store');
        Route::get('/payment-gateways-delete', [MyWithdrawalsController::class, 'delete'])->name('my.superuser.my.withdrawals.delete');
    });
    /* END WITHDRAWALS */
});
