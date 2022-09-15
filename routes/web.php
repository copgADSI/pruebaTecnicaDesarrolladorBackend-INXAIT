<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Reports\ReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('LaginPage.index');
});
 */

Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */

Route::controller(LandingPageController::class)->group(function () {
    Route::get('/', 'index')->name('landingPage.index');
    Route::post('/register-user', 'store')->name('landingPage.store');
    Route::get('/getCitiesByState', 'getCities')->name('landingPage.cities');
    Route::get('/sorteo', 'raffleView')->name('landingPage.raffle');
    Route::get('/generateRaffle', 'generateRaffle')->name('landingPage.generate_raffle');
});

Route::controller(ReportsController::class)->group(function(){
    Route::get('/reportes', 'index')->name('reports.index');
    Route::get('/generateUsersReport', 'generateUsersReport')->name('reports.generateUsers');
    Route::get('/generateRafflesReport', 'generateRafflesReport')->name('reports.generateRaffles');
});
