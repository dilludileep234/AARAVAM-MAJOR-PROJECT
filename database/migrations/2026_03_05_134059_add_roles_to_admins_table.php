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
        Schema::table('admins', function (Blueprint $table) {
            // These columns already exist in the database
            // $table->string('role')->default('super_admin')->after('password'); // super_admin, category_admin, coordinator
            // $table->string('category_access')->nullable()->after('role'); // e.g., 'Sports', 'Arts'
            // $table->string('status')->default('pending')->after('category_access'); // pending, approved, rejected
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['role', 'category_access', 'status']);
        });
    }
};
