<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('advertisement_translations', function (Blueprint $table) {
            $table->bigIncrements('advertisements_trans_id');
            $table->unsignedBigInteger('advertisements_id');
            $table->string('locale',2);
            $table->string('advertisements_web_img',200)->nullable();
            $table->string('advertisements_phone_img',200)->nullable();
            $table->text('advertisements_text')->nullable();
            $table->string('advertisements_url',255)->nullable();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('advertisements_id')->references('advertisements_id')->on('advertisements')->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('advertisement_translations');
    }
}
