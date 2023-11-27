<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('store_translations', function (Blueprint $table) {
            $table->bigIncrements('stores_trans_id');
            $table->unsignedBigInteger('stores_id');
            $table->string('locale',2)->nullable();
            $table->string('stores_name')->nullable();
            $table->text('stores_desc')->nullable();
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
        Schema::dropIfExists('store_translations');
    }
}
