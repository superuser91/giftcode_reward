<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::prefix('/giftcodes')->name('giftcodes.')->group(function () {
        Route::prefix('/categories')->name('categories.')->group(function () {
            Route::get('/', [GiftcodeCategoryController::class, 'index'])->name('index');
            Route::get('/create', [GiftcodeCategoryController::class, 'create'])->name('create');
            Route::post('/', [GiftcodeCategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [GiftcodeCategoryController::class, 'show'])->name('show');
            Route::get('/{category}/edit', [GiftcodeCategoryController::class, 'edit'])->name('edit');
            Route::patch('/{category}', [GiftcodeCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [GiftcodeCategoryController::class, 'destroy'])->name('destroy');
        });

        Route::get('/{category}/import', [GiftcodeController::class, 'showImportForm'])->name('import.show');
        Route::post('/{category}/import', [GiftcodeController::class, 'import'])->name('import');
    });
});
