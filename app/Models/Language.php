<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
