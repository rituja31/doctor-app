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
            // Add category_id if it doesn't exist
            if (!Schema::hasColumn('appointments', 'category_id')) {
                $table->foreignId('category_id')->constrained()->after('id');
            }

            // Add service_id if it doesn't exist
            if (!Schema::hasColumn('appointments', 'service_id')) {
                $table->foreignId('service_id')->constrained()->after('category_id');
            }

            // Add doctor_id if it doesn't exist
            if (!Schema::hasColumn('appointments', 'doctor_id')) {
                $table->foreignId('doctor_id')->constrained('doctors')->after('service_id');
            }

            // Add date if it doesn't exist
            if (!Schema::hasColumn('appointments', 'date')) {
                $table->date('date')->after('doctor_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop foreign keys if they exist
            if (Schema::hasColumn('appointments', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
            if (Schema::hasColumn('appointments', 'service_id')) {
                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');
            }
            if (Schema::hasColumn('appointments', 'doctor_id')) {
                $table->dropForeign(['doctor_id']);
                $table->dropColumn('doctor_id');
            }
            if (Schema::hasColumn('appointments', 'date')) {
                $table->dropColumn('date');
            }
        });
    }
};