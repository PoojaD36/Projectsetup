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
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
    $table->string('order_number')->unique();
    $table->enum('status', ['pending', 'processing', 'completed', 'declined'])->default('pending');
    $table->bigInteger('user_id')->nullable();
    $table->decimal('grand_total', 10, 2)->nullable();
    $table->integer('item_count')->nullable();
    $table->string('first_name')->nullable();
    $table->string('last_name')->nullable();
    $table->text('address')->nullable();
    $table->text('address_2')->nullable();
    $table->string('country')->nullable();
    $table->string('state')->nullable();
    $table->string('city')->nullable();
    $table->string('zip_code')->nullable();
    $table->string('phone')->nullable();
    $table->timestamps();
});
           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
