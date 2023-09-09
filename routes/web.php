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
    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);
    Route::get('/', function () {
        return redirect(route('login'));
    });
    Route::group([
        'prefix' => '/dashboard',
        'as' => 'dashboard.',
    ], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
        Route::get('/token-form', [App\Http\Controllers\HomeController::class, 'createToken'])->name('createToken');

        /* ---------- Tour Request Routes ---------- */
        Route::get('/tour-request', [App\Http\Controllers\TourRequestController::class, 'index'])->name('tourRequest');
        Route::get('/tour-request/group/{exhibit_id}', [App\Http\Controllers\TourRequestController::class, 'groupIndex'])->name('groupIndex');
        Route::get('/tour-request/view/{id}', [App\Http\Controllers\TourRequestController::class, 'show'])->name('viewTourRequest');
        Route::get('/tour-request/delete/{id}', [App\Http\Controllers\TourRequestController::class, 'destroy'])->name('destroyTourRequest');
        Route::post('/view-tour-request/{id}', [App\Http\Controllers\TourRequestController::class, 'update'])->name('updateTourRequest');

        /* ---------- Booth Building Routes ---------- */
        Route::get('/booth-building', [App\Http\Controllers\BoothBuildingController::class, 'index'])->name('boothBuilding');
        Route::get('/booth-building/group/{exhibit_id}', [App\Http\Controllers\BoothBuildingController::class, 'groupIndex'])->name('boothGroupIndex');
        Route::get('/booth-building/view/{id}', [App\Http\Controllers\BoothBuildingController::class, 'show'])->name('viewBoothBuilding');
        Route::get('/booth-building/delete/{id}', [App\Http\Controllers\BoothBuildingController::class, 'destroy'])->name('destroyBoothBuilding');
        Route::post('/booth-building/view/{id}', [App\Http\Controllers\BoothBuildingController::class, 'update'])->name('updateBoothBuilding');

        /* ---------- Booth Reserve Routes ---------- */
        Route::get('/booth-reserve', [App\Http\Controllers\BoothReserveController::class, 'index'])->name('boothReserve');
        Route::get('/booth-reserve/group/{exhibit_id}', [App\Http\Controllers\BoothReserveController::class, 'groupIndex'])->name('reserveGroupIndex');
        Route::get('/booth-reserve/view/{id}', [App\Http\Controllers\BoothReserveController::class, 'show'])->name('viewBoothReserve');
        Route::get('/booth-reserve/delete/{id}', [App\Http\Controllers\BoothReserveController::class, 'destroy'])->name('destroyBoothReserve');
        Route::post('/booth-reserve/view/{id}', [App\Http\Controllers\BoothReserveController::class, 'update'])->name('updateBoothReserve');

        /* ------------------------------------- Post Requests ------------------------------------- */
        Route::post('/generate-token', [App\Http\Controllers\HomeController::class, 'generateToken'])->name('generateToken');
        Route::post('/getCountries', [App\Http\Controllers\AjaxController::class, 'getCountries'])->name('getCountries');
        Route::post('/getCites', [App\Http\Controllers\AjaxController::class, 'getCites'])->name('getCites');
        Route::post('/getGenre', [App\Http\Controllers\AjaxController::class, 'getGenre'])->name('getGenre');
    });
    Route::get('/home', function () {
        if (\Session::get('locale') !== 'fa') {
            return redirect(url('/') . \Session::get('locale') . '/dashboard');
        }
        return redirect(route('dashboard.index'));
    });
});

function parseLocale()
{
    $locale = request()->segment(1);
    $locales = config('app.available_locales');
    $default = config('app.locale');

    if ($locale !== $default && in_array($locale, $locales, true)) {
        app()->setLocale($locale);

        return $locale;
    }
}

