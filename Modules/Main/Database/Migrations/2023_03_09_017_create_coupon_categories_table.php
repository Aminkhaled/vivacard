<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('coupon_categories', function (Blueprint $table) {
            $table->bigIncrements('coupons_categories_id');
            $table->unsignedBigInteger('coupons_id');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('coupons_id')->references('coupons_id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('categories_id')->references('categories_id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_categories');
    }
}
