<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('stores', function (Blueprint $table) {
            $table->bigIncrements('stores_id');
            $table->string('stores_code',255)->nullable() ;
            $table->string('stores_logo',255)->nullable() ;
            $table->string('stores_link',255)->nullable() ;
            $table->integer('stores_position')->default('1') ;
            $table->enum('stores_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            
            $table->timestamp('stores_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('stores_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('stores');
    }
}
