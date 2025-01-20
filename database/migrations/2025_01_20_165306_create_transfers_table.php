<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable(); // Title with translations
            $table->json('description')->nullable(); // Description with translations
            $table->string('image')->nullable(); // Image path
            $table->datetime('datetime'); // Transfer datetime
            $table->integer('count')->nullable(); // Passenger count
            $table->foreignId('departure_airport_id')->constrained('airports')->onDelete('cascade'); // Departure airport
            $table->foreignId('arrival_airport_id')->constrained('airports')->onDelete('cascade'); // Arrival airport
            $table->decimal('price', 10, 2); // Transfer price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
