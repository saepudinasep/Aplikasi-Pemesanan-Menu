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
        Schema::table('header_orders', function (Blueprint $table) {
            $table->renameColumn('payment', 'total');
            $table->renameColumn('bank', 'uang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('header_orders', function (Blueprint $table) {
            $table->renameColumn('total', 'payment');
            $table->renameColumn('uang', 'bank');
        });
    }
};
