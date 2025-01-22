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
        Schema::table('machines', function (Blueprint $table) {
            // Change the column name from 'lattitude' to 'latitude'
            $table->renameColumn('lattitude', 'latitude');

            // Change the default value of 'status' to 'active'
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            // Revert the column name change
            $table->renameColumn('latitude', 'lattitude');

            // Remove the default value for 'status'
            $table->enum('status', ['active', 'inactive'])->nullable()->change();
        });
    }
};
