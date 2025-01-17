<?php
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('/delete_languages', [\App\Http\Controllers\Admin\LanguageController::class, 'delete_languages'])->name('delete_languages');
    Route::post('/languages/reorder', [\App\Http\Controllers\Admin\LanguageController::class, 'reorder'])->name('languages.reorder');

    Route::post('/translations/update', [\App\Http\Controllers\Admin\TranslateController::class, 'updateTranslation'])->name('translations.update');
    Route::delete('/admin/translations/destroy', [\App\Http\Controllers\Admin\TranslateController::class, 'destroy'])->name('translations.destroy');
});
