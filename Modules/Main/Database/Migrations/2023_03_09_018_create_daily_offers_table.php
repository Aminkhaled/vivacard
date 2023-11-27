<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('daily_offers', function (Blueprint $table) {
            $table->bigIncrements('daily_offers_id');
            $table->unsignedBigInteger('daily_offers_code')->nullable();
            $table->unsignedBigInteger('stores_id')->nullable();
            $table->string('daily_offers_image',255)->nullable() ;
            $table->string('daily_offers_url',255)->nullable() ;
            $table->decimal('daily_offers_price',8,2)->nullable() ;
            $table->decimal('daily_offers_price_before_sale',8,2)->nullable() ;
            $table->integer('daily_offers_position')->default('1') ;
            $table->enum('daily_offers_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            
            $table->timestamp('daily_offers_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('daily_offers_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('stores_id')->references('stores_id')->on('stores')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('daily_offers');
    }
}
