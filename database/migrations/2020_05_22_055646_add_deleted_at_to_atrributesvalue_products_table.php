<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToAtrributesvalueProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atrributesvalue_products', function (Blueprint $table) {

            $table->dropForeign(['atrributesValue_id']);
            $table->foreign('atrributesValue_id')->references('id')->on('atrributesValue')->onDelete('CASCADE');
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
        Schema::table('atrributesvalue_products', function (Blueprint $table) {
            $table->dropForeign(['atrributesValue_id']);
            $table->foreign('atrributesValue_id')->references('id')->on('atrributesValue');
            $table->dropForeign(['product_id']);
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
}
