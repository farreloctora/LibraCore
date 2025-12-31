<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing records to 'dibooking' if they are 'dipinjam'
        DB::table('peminjamans')->where('status', 'dipinjam')->update(['status' => 'dibooking']);

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat', 'dibooking'])->default('dibooking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat', 'dibooking'])->default('dipinjam');
        });
    }
};
