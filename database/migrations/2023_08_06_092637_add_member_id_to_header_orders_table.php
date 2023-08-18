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
            $table->unsignedBigInteger('member_id')->after('table_id')->nullable();
            $table->foreign('member_id')->references('id')->on('members');
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
            $table->dropForeign('header_orders_member_id_foreign');
            $table->dropColumn('member_id');
        });
    }
};
