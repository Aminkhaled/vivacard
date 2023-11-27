<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('faq_translations', function (Blueprint $table) {
            $table->bigIncrements('faqs_trans_id');
            $table->unsignedBigInteger('faqs_id');
            $table->string('locale',2);
            $table->text('faqs_question')->nullable();
            $table->text('faqs_answer')->nullable();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->foreign('faqs_id')->references('faqs_id')->on('faqs')->onUpdate('cascade')
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
