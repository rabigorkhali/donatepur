<?php

use App\Http\Controllers\Frontend\CampaignController;
use App\Http\Controllers\Frontend\HomeController;



$namespacePrefix = '\\App\Http\Controllers\Frontend\\';


Route::get('/home', [HomeController::class, 'index'])->name('fontendHomePage');
Route::get('/', [HomeController::class, 'index'])->name('fontendDefaultPage');
Route::get('/campaigns/{slug}', [HomeController::class, 'campaignDetailPage'])->name('campaignDetailPage');
Route::get('/campaigns', [HomeController::class, 'campaignList'])->name('campaignList');
Route::get('/contact-us', [HomeController::class, 'contactUsView'])->name('frontendContactus');
Route::post('/contact-us', [HomeController::class, 'contactUsCreate'])->name('frontendContactusCreate');
Route::get('/page/{pageType}', [HomeController::class, 'getPage'])->name('frontendPage');
Route::get('/blogs', [HomeController::class, 'postList'])->name('postList');
Route::get('/blogs/{slug}', [HomeController::class, 'postDetailPage'])->name('postDetailPage');
Route::post('/save-location/{campaign}', [HomeController::class, 'saveLocation'])->name('saveLocation');

Route::get('/sync-expired-campaigns', [HomeController::class, 'syncExpiredCampaigns'])->name('syncExpiredCampaigns');

/* DONATION PAYMENT URLS */
Route::get('/payment/khalti/verfication', [HomeController::class, 'khaltiPaymentVerification'])->name('khaltiPaymentVerification');
Route::post('/donation', [HomeController::class, 'getDonation'])->name('getDonation');
Route::get('/esewa/success', [HomeController::class, 'esewaPaymentSuccess'])->name('esewaSuccess');
Route::get('/esewa/failure', [HomeController::class, 'esewaPaymentFailure'])->name('esewaFailure');
