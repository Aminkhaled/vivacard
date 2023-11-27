<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('articles_categories', function (Blueprint $table) {
            $table->bigIncrements('articles_categories_id');
            $table->integer('articles_categories_position')->default('1') ;
            $table->enum('articles_categories_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            
            $table->timestamp('articles_categories_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('articles_categories_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('articles_categories');
    }
}
