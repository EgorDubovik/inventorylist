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
            $table->string('customer_email');
            $table->string('dest_customer_email');
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
            $table->dropColumn('customer_email');
            $table->dropColumn('dest_customer_email');
        });
    }
};
