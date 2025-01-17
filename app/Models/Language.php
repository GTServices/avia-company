<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Handle is_main logic automatically.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->is_main) {
                static::resetIsMain();
            }

            // JSON faylı yaradılması
            static::createJsonFile($model->lang_code);
        });

        static::updating(function ($model) {
            if ($model->is_main) {
                static::resetIsMain($model->id);
            } elseif (!$model->is_main && !static::where('is_main', true)->exists()) {
                $randomLanguage = static::where('id', '!=', $model->id)->first();
                if ($randomLanguage) {
                    $randomLanguage->update(['is_main' => true]);
                }
            }

            // JSON faylının adını dəyiş
            if ($model->isDirty('lang_code')) {
                static::renameJsonFile($model->getOriginal('lang_code'), $model->lang_code);
            }
        });

        static::deleting(function ($model) {
            // JSON faylını sil
            static::deleteJsonFile($model->lang_code);
        });
    }

    /**
     * Reset is_main for all languages except the given ID.
     */
    protected static function resetIsMain($excludeId = null)
    {
        $query = static::query()->where('is_main', true);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        $query->update(['is_main' => false]);
    }

    /**
     * Create a JSON file for the language.
     */
    protected static function createJsonFile($langCode)
    {
        $filePath = resource_path("lang/{$langCode}.json");
        if (!File::exists($filePath)) {
            File::put($filePath, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    /**
     * Rename a JSON file when lang_code is updated.
     */
    protected static function renameJsonFile($oldLangCode, $newLangCode)
    {
        $oldFilePath = resource_path("lang/{$oldLangCode}.json");
        $newFilePath = resource_path("lang/{$newLangCode}.json");

        if (File::exists($oldFilePath)) {
            File::move($oldFilePath, $newFilePath);
        }
    }

    /**
     * Delete a JSON file when a language is deleted.
     */
    protected static function deleteJsonFile($langCode)
    {
        $filePath = resource_path("lang/{$langCode}.json");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
