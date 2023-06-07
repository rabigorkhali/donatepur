<?php

use App\Http\Controllers\Frontend\CampaignController;
use App\Http\Controllers\Frontend\HomeController;



$namespacePrefix = '\\App\Http\Controllers\Frontend\\';


Route::get('/home', [HomeController::class, 'index'])->name('fontendHomePage');
Route::get('/', [HomeController::class, 'index'])->name('fontendHomePage');
Route::get('/campaigns/{id}', [CampaignController::class, 'campaignDetailPage'])->name('campaignDetailPage');

