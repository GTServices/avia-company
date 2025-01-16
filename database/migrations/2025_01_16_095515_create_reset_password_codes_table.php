<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetPasswordCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_password_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index(); // İstifadəçi emaili
            $table->string('reset_code'); // Reset kodu
            $table->timestamp('resetted_at')->nullable(); // Şifrə yeniləmə tarixi
            $table->timestamps(); // Created_at və updated_at sütunları
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reset_password_codes');
    }
}
