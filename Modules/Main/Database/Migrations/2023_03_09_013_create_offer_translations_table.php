<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('offer_translations', function (Blueprint $table) {
            $table->bigIncrements('offers_trans_id');
            $table->unsignedBigInteger('offers_id');
            $table->string('locale',2)->nullable();
            $table->string('offers_name')->nullable();
            $table->text('offers_desc')->nullable();
            $table->foreign('offers_id')->references('offers_id')->on('offers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('offer_translations');
    }
}
