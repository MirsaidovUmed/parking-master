<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\BlackListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingHistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SistemSettingsController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarrierController;
use App\Http\Controllers\WhitelistController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
*/

require_once __DIR__ . "/auth/auth.php";
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::prefix('users')
        ->controller(UserController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('users.index');
            Route::get('/create/', 'create')->name('users.create');
            Route::get('/edit/{id}', 'edit')->name('users.edit');
            Route::put('/update/{id}', 'update')->name('users.update');
            Route::post('/store/', 'store')->name('users.store');
            Route::delete('/delete/{id}', 'destroy')->name('users.delete');
        });

    Route::prefix('accesses')
        ->controller(AccessController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('Список доступы');
            Route::get('/create/', 'create')->name('Создать доступ');
            Route::get('/edit/{id}', 'edit')->name('Просмотр доступ');
            Route::put('/update/{id}', 'update')->name('Изменить доступ');
            Route::post('/store/', 'store')->name('Добавить доступ');
            Route::delete('/delete/{id}', 'destroy')->name('Удалить доступ');
        });

    Route::prefix('roles')
        ->controller(RoleController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('Список ролей');
            Route::get('/create/', 'create')->name('Создать роль');
            Route::get('/edit/{id}', 'edit')->name('Просмотр роль');
            Route::put('/update/{id}', 'update')->name('Изменить роль');
            Route::post('/store/', 'store')->name('Добавить роль');
            Route::delete('/delete/{id}', 'destroy')->name('Удалить роль');
        });

    Route::prefix('statistics')
        ->controller(StatisticController::class)
        ->group(function () {
            Route::get('/statistic', 'index')->name('statistics.main');
        });

    Route::prefix('blacklist')
        ->controller(BlackListController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('blacklist.index');
            Route::post('/store', 'store')->name('blacklist.store');
            Route::put('/update/{id}', 'update')->name('blacklist.update');
            Route::delete('/destroy/{id}', 'destroy')->name('blacklist.destroy');
        });

    Route::prefix('whitelist')
        ->controller(WhitelistController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('whitelist.index');
            Route::post('/store', 'store')->name('whitelist.store');
            Route::put('/update/{id}', 'update')->name('whitelist.update');
            Route::delete('/delete/{id}', 'destroy')->name('whitelist.delete');
        });

    Route::prefix('tariff')
        ->controller(TariffController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('tariff.index');
            Route::post('/store', 'store')->name('tariff.store');
            Route::get('/edit/{id}', 'edit')->name('tariff.edit');
            Route::put('/update/{id}', 'update')->name('tariff.update');
            Route::delete('/delete/{id}', 'destroy')->name('tariff.delete');
        });

    Route::prefix('subscription')
        ->controller(SubscriptionController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('subscription.index');
            Route::get('/history', 'history')->name('subscription.history');
            Route::post('/store', 'store')->name('subscription.store');
            Route::get('/edit/{id}', 'edit')->name('subscription.edit');
            Route::put('/update/{id}', 'update')->name('subscription.update');
            Route::delete('/delete/{id}', 'destroy')->name('subscription.delete');
        });

    Route::prefix('payment')
        ->controller(PaymentController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('payment.index');
        });

    Route::prefix('parking_history')
    ->controller(ParkingHistoryController::class)
    ->group(function () {
        Route::get('/index', 'index')->name('parking_history.index');
        Route::get('/{id}/photos', 'photos')->name('parking_history.photos');
        Route::get('/parking-history/{id}/download', 'download')->name('parking-history.download');
        Route::get('/parking-history/{id}/download-all', 'downloadAll')->name('parking-history.downloadAll');

         Route::get('/photos', 'photosList')->name('parking_history.photosList');
    });

    Route::prefix('sistem_settings')
    ->controller(SistemSettingsController::class)
    ->group(function () {
        Route::get('/index', 'index')->name('sistem_settings.index');
    });

    Route::prefix('barriers')
        ->controller(BarrierController::class)
        ->group(function () {
            Route::get('/index', 'index')->name('barriers.index');
            Route::post('/store', 'store')->name('barriers.store');
            Route::get('/edit/{id}', 'edit')->name('barriers.edit');
            Route::put('/update/{id}', 'update')->name('barriers.update');
            Route::delete('/delete/{id}', 'destroy')->name('barriers.delete');
            Route::post('/bulk', 'bulk')->name('barriers.bulk');
            Route::post('/live/enter', 'liveEnter')->name('barriers.live.enter');
            Route::post('/live/{id}/open', 'liveOpen')->name('barriers.live.open');
            Route::post('/live/{id}/close', 'liveClose')->name('barriers.live.close');
            Route::post('/live/{id}/exit', 'liveExit')->name('barriers.live.exit');
        });
});
