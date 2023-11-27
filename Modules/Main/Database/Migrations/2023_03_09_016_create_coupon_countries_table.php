<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('coupon_countries', function (Blueprint $table) {
            $table->bigIncrements('coupons_countries_id');
            $table->unsignedBigInteger('coupons_id');
            $table->unsignedBigInteger('countries_id');
            $table->foreign('coupons_id')->references('coupons_id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('countries_id')->references('countries_id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_countries');
    }
}
