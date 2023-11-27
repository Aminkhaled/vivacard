<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponFavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('coupon_favs', function (Blueprint $table) {
            $table->bigIncrements('coupon_favs_id');
            $table->unsignedBigInteger('coupons_id');
            $table->unsignedBigInteger('customers_id');
            $table->foreign('coupons_id')->references('coupons_id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customers_id')->references('customers_id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_favs');
    }
}
