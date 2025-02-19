<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Change4columnsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('name')->nullable(true)->change();
            $table->string('post_code')->nullable(true)->change();
            $table->string('address')->nullable(true)->change();
            $table->string('image')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('post_code')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
        });
    }
}
