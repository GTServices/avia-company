<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Boot method to handle is_main updates.
     */
    protected static function boot()
    {
        parent::boot();

        // Handle the is_main field on creating
        static::creating(function ($model) {
            if ($model->is_main) {
                // Reset other is_main records to false
                static::where('is_main', true)->update(['is_main' => false]);
            }
        });

        // Handle the is_main field on updating
        static::updating(function ($model) {
            if ($model->is_main) {
                // Reset other is_main records to false
                static::where('is_main', true)->where('id', '!=', $model->id)->update(['is_main' => false]);
            } elseif (!$model->is_main && static::where('is_main', true)->doesntExist()) {
                // If no other record has is_main, set one randomly
                $randomLanguage = static::where('id', '!=', $model->id)->first();
                if ($randomLanguage) {
                    $randomLanguage->update(['is_main' => true]);
                }
            }
        });
    }
}
