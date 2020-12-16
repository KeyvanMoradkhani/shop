<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPhotoProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photo_product', function (Blueprint $table) {
            $table->dropForeign(['photo_id']);
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('CASCADE');
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photo_product', function (Blueprint $table) {
            $table->dropForeign(['photo_id']);
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
}
