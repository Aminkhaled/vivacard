<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('articles', function (Blueprint $table) {
            $table->bigIncrements('articles_id');
            $table->unsignedBigInteger('articles_categories_id');
            $table->date('articles_date')->nullable() ;
            $table->string('articles_image')->nullable() ;
            $table->integer('articles_position')->default('1') ;
            $table->string('articles_views')->nullable() ;
            $table->string('articles_featured')->nullable() ;
            $table->enum('articles_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
 
            $table->timestamp('articles_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('articles_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('articles');
    }
}
