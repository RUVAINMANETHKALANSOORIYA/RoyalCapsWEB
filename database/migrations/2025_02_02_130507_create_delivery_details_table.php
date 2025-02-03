<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id(); // This creates an unsigned big integer column
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('postal_code');
            $table->text('delivery_address');
            $table->text('delivery_instructions')->nullable();
            $table->enum('status', ['Pending', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending'); // Delivery Status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_details');
    }
};