<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveItemIdFromShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropForeign('shipping_addresses_item_id_foreign');
            $table->dropColumn('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
        });
    }
}
