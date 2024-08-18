<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('prod_sku');
            $table->string('prod_Live_URL');
            $table->string('prod_name');
            $table->text('prod_long_desc');
            $table->enum('prod_type',['Wedding Bands','Wedding Rings']);
            $table->text('prod_subcategory');
            $table->enum('prodmeta_section',['Mens','Womens']);
            $table->integer('prodmeta_ship_days');
            $table->string('prodmeta_metal_weight');
            $table->integer('prodmeta_side_diamonds_count')->nullable();
            $table->string('prodmeta_side_diamonds_ctw');
            $table->string('prodmeta_side_diamonds_color_clarity');
            $table->integer('prodmeta_side_diamonds1_count')->nullable();
            $table->integer('attr_14k_regular')->nullable();
            $table->string('attr_14k_metal_available');
            $table->integer('attr_18k_regular')->nullable();
            $table->string('attr_18k_metal_available');
            $table->integer('attr_platinum_regular')->nullable();
            $table->string('attr_whitegold_platinum_round_default_img');
            $table->string('attr_whitegold_platinum_round_img');
            $table->string('attr_rosegold_round_default_img');
            $table->string('attr_rosegold_round_img');
            $table->string('attr_yellowgold_round_default_img');
            $table->string('attr_yellowgold_round_img');
            $table->string('attr_whitegold_yellow_round_default_img');
            $table->string('attr_whitegold_yellow_round_img');
            $table->string('attr_whitegold_rose_round_default_img');
            $table->string('attr_whitegold_rose_round_img');
            $table->string('attr_tricolor_round_default_img');
            $table->string('attr_tricolor_round_img');
            $table->timestamps();
        });
    }
  
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
