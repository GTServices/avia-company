<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivacyPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->json('policy')->nullable(); // Tərcümələr üçün JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('privacy_policies');
    }
}
