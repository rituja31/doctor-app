<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdServiceIdToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->after('phone');
            $table->foreignId('service_id')->constrained()->onDelete('cascade')->after('category_id');
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['category_id', 'service_id']);
        });
    }
}