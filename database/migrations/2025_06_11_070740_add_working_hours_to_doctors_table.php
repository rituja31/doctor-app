<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkingHoursToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->json('start_time')->nullable()->after('timings');
            $table->json('end_time')->nullable()->after('start_time');
            $table->json('break_start_time')->nullable()->after('end_time');
            $table->json('break_end_time')->nullable()->after('break_start_time');
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time', 'break_start_time', 'break_end_time']);
        });
    }
}