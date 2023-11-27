<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('categories', function (Blueprint $table) {
            $table->bigIncrements('categories_id');
            $table->string('categories_code',255)->nullable() ;
            $table->string('categories_image',255)->nullable() ;
            $table->bigInteger('categories_parent_id')->nullable() ;
            $table->integer('stores_position')->default('1') ;
            $table->enum('stores_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            $table->integer('lft')->nullable() ;
            $table->integer('rgt')->nullable() ;
            $table->integer('depth')->default('0') ;

            $table->timestamp('categories_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('categories_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('categories');
    }
}
