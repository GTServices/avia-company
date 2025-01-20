<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin', 'web']], function () {
    Route::post('/delete_languages', [\App\Http\Controllers\Admin\LanguageController::class, 'delete_languages'])->name('delete_languages');
    Route::post('/languages/reorder', [\App\Http\Controllers\Admin\LanguageController::class, 'reorder'])->name('languages.reorder');

    Route::post('/translations/update', [\App\Http\Controllers\Admin\TranslateController::class, 'updateTranslation'])->name('translations.update');
    Route::delete('/translations/destroy', [\App\Http\Controllers\Admin\TranslateController::class, 'destroy'])->name('translations.destroy');
    Route::post('/tours/delete_selected', [\App\Http\Controllers\Admin\TourController::class, 'delete_selected'])->name('tours.delete_selected');
    Route::post('/cities/delete_selected', [\App\Http\Controllers\Admin\CityController::class, 'delete_selected'])->name('cities.delete_selected');
    Route::post('/airports/delete_selected', [\App\Http\Controllers\Admin\AirportController::class, 'delete_selected'])->name('airports.delete_selected');
    Route::post('/transfers/delete_selected', [\App\Http\Controllers\Admin\TransferController::class, 'delete_selected'])->name('transfers.delete_selected');
});
