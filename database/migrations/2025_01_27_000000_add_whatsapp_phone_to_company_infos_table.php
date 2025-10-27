<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappPhoneToCompanyInfosTable extends Migration
{
    public function up()
    {
        Schema::table('company_infos', function (Blueprint $table) {
            $table->string('whatsapp_phone')->nullable()->after('whatsapp');
        });
    }

    public function down()
    {
        Schema::table('company_infos', function (Blueprint $table) {
            $table->dropColumn('whatsapp_phone');
        });
    }
}

