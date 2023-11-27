<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyOfferTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('daily_offer_translations', function (Blueprint $table) {
            $table->bigIncrements('daily_offers_trans_id');
            $table->unsignedBigInteger('daily_offers_id');
            $table->string('locale',2)->nullable();
            $table->string('daily_offers_name')->nullable();
            $table->foreign('daily_offers_id')->references('daily_offers_id')->on('daily_offers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('daily_offer_translations');
    }
}
