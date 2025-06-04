<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimingFieldsFromDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'finish_time', 'break_start_time', 'break_end_time']);
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('start_time');
            $table->string('finish_time');
            $table->string('break_start_time');
            $table->string('break_end_time');
        });
    }
}