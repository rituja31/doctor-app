<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->after('id');
            $table->foreignId('service_id')->constrained()->after('category_id');
            $table->foreignId('doctor_id')->constrained('doctors')->after('service_id');
            $table->date('date')->after('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['category_id', 'service_id', 'doctor_id', 'date']);
        });
    }
};
