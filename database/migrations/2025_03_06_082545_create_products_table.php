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
            $table->boolean('is_service')->default(false);
            $table->string('item_name');
            $table->string('slug')->unique();
            // $table->string('code')->unique();
            $table->string('item_model')->nullable();
            $table->string('item_code')->unique();
            $table->string('brand')->nullable();
            $table->string('unit')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_type')->nullable();
            $table->double('regular_price', 12, 2)->nullable();
            $table->double('discount', 5, 2)->nullable();
            $table->double('selling_price', 12, 2)->nullable();
            // $table->double('inventory_count', 12, 2)->nullable();
            // $table->unsignedTinyInteger('alert_qty')->nullable();
            $table->boolean('status')->default(true);
            $table->string('note')->nullable();
            $table->json('voice_tags')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('sub_cat_id');
            $table->timestamps();
            // $table->unsignedBigInteger('brand_id')->nullable();
            // $table->unsignedBigInteger('unit_id')->nullable();
            // $table->unsignedBigInteger('tax_id')->nullable();
            // $table->double('opening_stock_count', 12, 2)->nullable();
            // $table->double('opening_stock_unit_price', 12, 2)->nullable();

            // Foreign Keys
            $table->foreign('sub_cat_id')->references('id')->on('sub_categories')->onDelete('cascade');
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');
            // $table->foreign('tax_id')->references('id')->on('vat_rates')->onDelete('set null');
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
