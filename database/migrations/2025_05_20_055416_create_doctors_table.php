<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Add foreign key
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Add foreign key
            $table->string('specialties');
            $table->string('status');
            $table->string('password');
            $table->string('start_time'); // HH:mm (e.g., 09:00)
            $table->string('finish_time');
            $table->string('break_start_time');
            $table->string('break_end_time');
            $table->string('working_days'); // Comma-separated (e.g., Monday,Tuesday)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}