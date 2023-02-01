<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_category', function (Blueprint $table) {
            $table->string("tape_lot_number");
            $table->string("tape_color");
            $table->string("van_number");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_category', function (Blueprint $table) {
            $table->dropColumn("tape_lot_number");
            $table->dropColumn("tape_color");
            $table->dropColumn("van_number");
        });
    }
};
