<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->string('status')->index()->after('id'); // 'id'-dən sonra 'status' sahəsini əlavə edir
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropIndex(['status']); // 'status' sahəsinin indeksini silir
            $table->dropColumn('status'); // 'status' sahəsini silir
        });
    }
};
