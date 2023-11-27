<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('article_translations', function (Blueprint $table) {
            $table->bigIncrements('articles_trans_id');
            $table->unsignedBigInteger('articles_id');
            $table->string('locale',2)->nullable();
            $table->string('articles_title')->nullable();
            $table->string('articles_slug')->nullable();
            $table->text('articles_desc')->nullable();
            $table->string('articles_seo_title')->nullable();
            $table->text('articles_seo_desc')->nullable();
            $table->text('articles_seo_keyword')->nullable();
            $table->foreign('articles_id')->references('articles_id')->on('articles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('article_translations');
    }
}
