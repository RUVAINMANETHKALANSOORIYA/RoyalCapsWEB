<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('custom', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending')->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('custom', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
