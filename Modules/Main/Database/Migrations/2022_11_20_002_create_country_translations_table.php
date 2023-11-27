<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('country_translations', function (Blueprint $table) {
            $table->bigIncrements('countries_trans_id');
            $table->unsignedBigInteger('countries_id');
            $table->string('locale',2)->nullable();
            $table->string('countries_name')->nullable();
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
        Schema::dropIfExists('country_translations');
    }
}
