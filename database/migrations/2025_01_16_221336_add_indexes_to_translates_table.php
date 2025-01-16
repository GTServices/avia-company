<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translates', function (Blueprint $table) {
            $table->index('lang_code');
            $table->index('site_lang_code');
            $table->index('is_main');
            $table->index('lang_name');
            $table->index('site_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translates', function (Blueprint $table) {
            $table->dropIndex(['lang_code']);
            $table->dropIndex(['site_lang_code']);
            $table->dropIndex(['is_main']);
            $table->dropIndex(['lang_name']);
            $table->dropIndex(['site_name']);
        });
    }
}
