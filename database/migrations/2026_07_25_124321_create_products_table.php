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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();
 
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
 
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->unsignedInteger('quantity')->default(0);
 
            // Metric / size, e.g. 500 + gm, 1.5 + kg, 250 + ml
            $table->decimal('size_value', 8, 2)->nullable();
            $table->enum('size_unit', ['mg', 'gm', 'kg', 'ml', 'l', 'cm', 'm', 'pcs'])
                ->nullable();
 
            $table->boolean('featured')->default(false);
            $table->boolean('is_active')->default(true);
 
            $table->timestamps();
 
            $table->index(['featured', 'is_active']);
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
