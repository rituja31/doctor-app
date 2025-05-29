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
        $table->string('specialties');
        $table->enum('status', ['Active', 'On Leave', 'Retired'])->default('Active');
        $table->timestamps();
    });
}

}
