<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('countries', function (Blueprint $table) {
            $table->bigIncrements('countries_id');
            $table->enum('countries_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            $table->string('countries_code',255)->nullable() ;
            $table->integer('countries_position')->default('1') ;
            $table->integer('countries_currency')->nullable() ;

            $table->timestamp('countries_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('countries_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

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
        Schema::dropIfExists('countries');
    }
}
