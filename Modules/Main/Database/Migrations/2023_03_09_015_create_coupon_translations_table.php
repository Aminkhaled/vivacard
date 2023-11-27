<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('coupon_translations', function (Blueprint $table) {
            $table->bigIncrements('coupons_trans_id');
            $table->unsignedBigInteger('coupons_id');
            $table->string('locale',2)->nullable();
            $table->string('coupons_name',255)->nullable();
            $table->string('coupons_long_name',255)->nullable();
            $table->text('coupons_desc')->nullable();
            $table->text('coupons_offers_desc')->nullable();
            $table->foreign('coupons_id')->references('coupons_id')->on('coupons')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_translations');
    }
}
