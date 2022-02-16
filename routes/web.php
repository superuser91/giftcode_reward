<?php

use Illuminate\Support\Facades\Route;
use Vgplay\Giftcode\Controllers\GiftcodeController;
use Vgplay\Giftcode\Controllers\GiftcodeRecordController;

Route::middleware('web')->group(function () {
    Route::group([
        'prefix' => config('vgplay.giftcodes.prefix'),
        'middleware' => config('vgplay.giftcodes.middleware')
    ], function () {
        Route::prefix('/giftcodes')->name('giftcodes.')->group(function () {
            Route::get('/', [GiftcodeController::class, 'index'])->name('index');
            Route::get('/d/{giftcode}', [GiftcodeController::class, 'show'])->name('show');
            Route::get('/create', [GiftcodeController::class, 'create'])->name('create');
            Route::post('/', [GiftcodeController::class, 'store'])->name('store');
            Route::get('/d/{giftcode}/edit', [GiftcodeController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/d/{giftcode}', [GiftcodeController::class, 'update'])->name('update');
            Route::delete('/d/{giftcode}', [GiftcodeController::class, 'destroy'])->name('destroy');
            Route::get('/d/{giftcode}/records/import', [GiftcodeRecordController::class, 'showImportForm'])->name('records.import.show');
            Route::post('/d/{giftcode}/records', [GiftcodeRecordController::class, 'import'])->name('records.import');
        });
    });
});
