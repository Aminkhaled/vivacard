<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('articles_category_translations', function (Blueprint $table) {
            $table->bigIncrements('articles_categories_trans_id');
            $table->unsignedBigInteger('articles_categories_id');
            $table->string('locale',2)->nullable();
            $table->string('articles_categories_name')->nullable();
            $table->foreign('articles_categories_id')->references('articles_categories_id')->on('articles_categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('articles_category_translations');
    }
}
