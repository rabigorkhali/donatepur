<?php

use App\Http\Controllers\Frontend\CampaignController;
use App\Http\Controllers\Frontend\HomeController;



$namespacePrefix = '\\App\Http\Controllers\Frontend\\';


Route::get('/home', [HomeController::class, 'index'])->name('fontendHomePage');
Route::get('/', [HomeController::class, 'index'])->name('fontendDefaultPage');
Route::get('/campaigns/{slug}', [HomeController::class, 'campaignDetailPage'])->name('campaignDetailPage');
Route::get('/contact-us', [HomeController::class, 'contactUsView'])->name('frontendContactus');
Route::post('/contact-us', [HomeController::class, 'contactUsCreate'])->name('frontendContactusCreate');
Route::get('/page/{pageType}', [HomeController::class, 'getPage'])->name('frontendPage');
Route::post('/donation', [HomeController::class, 'getDonation'])->name('getDonation');


