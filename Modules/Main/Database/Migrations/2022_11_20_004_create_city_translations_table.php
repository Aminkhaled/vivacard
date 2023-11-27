<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('city_translations', function (Blueprint $table) {
            $table->bigIncrements('cities_trans_id');
            $table->unsignedBigInteger('cities_id');
            $table->string('locale',2)->nullable();
            $table->string('cities_name')->nullable();
            $table->foreign('cities_id')->references('cities_id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('city_translations');
    }
}
