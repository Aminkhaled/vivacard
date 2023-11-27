<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('coupons', function (Blueprint $table) {
            $table->bigIncrements('coupons_id');
            $table->unsignedBigInteger('stores_id')->nullable();
            $table->unsignedBigInteger('offers_id')->nullable();
            $table->string('coupons_image',255)->nullable() ;
            $table->string('coupons_code',255)->nullable() ;
            $table->integer('coupons_position')->default('1') ;
            $table->integer('coupons_click_counts')->default('0') ;
            $table->enum('coupons_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            $table->enum('coupons_available',['0','1'])->default('1')->comment('0 => not_available , 1 => available');
            $table->enum('coupons_is_special',['0','1'])->default('1')->comment('0 => no , 1 => yes');

            $table->timestamp('coupons_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('coupons_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('stores_id')->references('stores_id')->on('stores')->onUpdate('set null')->onDelete('set null');
            $table->foreign('offers_id')->references('offers_id')->on('offers')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('coupons');
    }
}
