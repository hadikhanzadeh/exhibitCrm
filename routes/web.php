<?php

use Illuminate\Support\Facades\Route;

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


Route::prefix(parseLocale())->group(function () {
    Auth::routes();
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

function parseLocale(){
    $locale = request()->segment(1);
    $locales = config('app.available_locales');
    $default = config('app.locale');

    if ($locale !== $default && in_array($locale, $locales, true)) {
        app()->setLocale($locale);

        return $locale;
    }
}

