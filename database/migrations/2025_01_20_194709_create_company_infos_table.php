<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('favicon')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('email_2')->nullable();
            $table->string('phone_2')->nullable();
            $table->json('address')->nullable(); // Translatable
            $table->json('copyright_text')->nullable(); // Translatable
            // Sosial şəbəkələr üçün sütunlar
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('x')->nullable(); // Twitter kimi
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
}
