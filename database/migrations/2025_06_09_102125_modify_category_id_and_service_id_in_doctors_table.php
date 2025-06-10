<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Drop foreign key constraints if they exist
            try {
                $table->dropForeign(['category_id']);
            } catch (\Exception $e) {
                // Ignore if constraint doesn't exist
            }
            try {
                $table->dropForeign(['service_id']);
            } catch (\Exception $e) {
                // Ignore if constraint doesn't exist
            }
            // Change columns to text
            $table->text('category_id')->nullable()->change();
            $table->text('service_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // Revert to integer (adjust based on original schema)
            $table->integer('category_id')->nullable()->change();
            $table->integer('service_id')->nullable()->change();
        });
    }
};