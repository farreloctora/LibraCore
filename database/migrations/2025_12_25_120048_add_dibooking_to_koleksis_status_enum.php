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
        Schema::table('koleksis', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('koleksis', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak', 'hilang', 'dibooking'])->default('tersedia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('koleksis', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('koleksis', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak', 'hilang'])->default('tersedia');
        });
    }
};
