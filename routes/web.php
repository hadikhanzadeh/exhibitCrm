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
    });
    Route::get('/home', function () {
        if (\Session::get('locale') !== 'fa') {
            return redirect('/' . \Session::get('locale') . '/dashboard');
        }
        return redirect('/dashboard');
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

