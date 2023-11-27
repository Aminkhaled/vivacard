<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('offers', function (Blueprint $table) {
            $table->bigIncrements('offers_id');
            $table->string('offers_image',255)->nullable() ;
            $table->integer('offers_position')->default('1') ;
            $table->enum('offers_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');

            $table->timestamp('offers_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('offers_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('offers');
    }
}
