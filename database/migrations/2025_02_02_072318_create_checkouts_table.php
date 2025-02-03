<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('postal_code');
            $table->text('delivery_address');
            $table->text('delivery_instructions')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending'); // Status of the order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
