<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('info_translations', function (Blueprint $table) {
            $table->bigIncrements('infos_trans_id');
            $table->unsignedBigInteger('infos_id');
            $table->string('locale',2);
            $table->string('infos_title',200)->nullable();
            $table->text('infos_desc')->nullable();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('infos_id')->references('infos_id')->on('infos')->onUpdate('cascade')
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
        Schema::connection('mysql')->dropIfExists('info_translations');
    }
}
