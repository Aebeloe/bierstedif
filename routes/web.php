<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Main pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/om-foreningen', [PageController::class, 'omForeningen'])->name('om-foreningen');
Route::get('/kalender', [PageController::class, 'kalender'])->name('kalender');
Route::get('/kontakt', [PageController::class, 'kontakt'])->name('kontakt');
Route::get('/klubdragt', [PageController::class, 'klubdragt'])->name('klubdragt');
Route::get('/sponsorer', [PageController::class, 'sponsorer'])->name('sponsorer');

// Tilmeldinger
Route::prefix('tilmeldinger')->name('tilmeldinger.')->group(function () {
    Route::get('/proevetraening', fn () => app(PageController::class)->tilmelding('Proevetraening'))->name('proevetraening');
    Route::get('/badminton', fn () => app(PageController::class)->tilmelding('Badminton'))->name('badminton');
    Route::get('/fodbold', fn () => app(PageController::class)->tilmelding('Fodbold'))->name('fodbold');
    Route::get('/gymnastik', fn () => app(PageController::class)->tilmelding('Gymnastik'))->name('gymnastik');
    Route::get('/haandbold', fn () => app(PageController::class)->tilmelding('Haandbold'))->name('haandbold');
    Route::get('/esport', fn () => app(PageController::class)->tilmelding('Esport'))->name('esport');
    Route::get('/familiemedlemskab', fn () => app(PageController::class)->tilmelding('Familiemedlemskab'))->name('familiemedlemskab');
    Route::get('/ungdomsklub', fn () => app(PageController::class)->tilmelding('Ungdomsklub'))->name('ungdomsklub');
    Route::get('/oevrige-hold', fn () => app(PageController::class)->tilmelding('OevrigeHold'))->name('oevrige-hold');
});

// Udvalg
Route::prefix('udvalg')->name('udvalg.')->group(function () {
    Route::get('/moselobet', fn () => app(PageController::class)->udvalgPage('Moselobet'))->name('moselobet');
    Route::get('/biersted-nyt', fn () => app(PageController::class)->udvalgPage('BierstedNyt'))->name('biersted-nyt');
    Route::get('/tuen', fn () => app(PageController::class)->udvalgPage('Tuen'))->name('tuen');
    Route::get('/kulturudvalget', fn () => app(PageController::class)->udvalgPage('Kulturudvalget'))->name('kulturudvalget');
    Route::get('/hjaelperbank', fn () => app(PageController::class)->udvalgPage('Hjaelperbank'))->name('hjaelperbank');
});
