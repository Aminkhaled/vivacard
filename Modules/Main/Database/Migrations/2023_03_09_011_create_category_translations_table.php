<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('category_translations', function (Blueprint $table) {
            $table->bigIncrements('categories_trans_id');
            $table->unsignedBigInteger('categories_id');
            $table->string('locale',2)->nullable();
            $table->string('categories_name',255)->nullable();
            $table->string('categories_slug',255)->nullable();
            $table->string('categories_seo_title',255)->nullable();
            $table->text('categories_seo_desc')->nullable();
            $table->text('categories_seo_keyword')->nullable();
            
            $table->foreign('categories_id')->references('categories_id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('category_translations');
    }
}
