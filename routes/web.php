<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



require __DIR__ . '/auth.php';
include('frontend.php'); //public domains
include('voyager.php'); //voyager
include('profile.php'); // users admin

Route::get('/error', function () {
    return view('frontend.errorpage');
})->name('frontend.error.page');
