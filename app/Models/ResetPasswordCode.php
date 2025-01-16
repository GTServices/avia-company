<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordCode extends Model
{
    use HasFactory;

    /**
     * Cədvəlin adı.
     *
     * @var string
     */
    protected $table = 'reset_password_codes';

    /**
     * Kütləvi doldurulan sütunlar.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'reset_code',
        'resetted_at',
    ];

    /**
     * Sütunların default olaraq datetime formatında gəlməsini təmin edir.
     *
     * @var array
     */
    protected $casts = [
        'resetted_at' => 'datetime',
    ];
}
