<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('cities', function (Blueprint $table) {
            $table->bigIncrements('cities_id');
            $table->string('cities_code',20)->nullable();
            $table->unsignedBigInteger('countries_id');
            $table->enum('cities_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            $table->string('name',255)->nullable();
            $table->integer('cities_position')->default('1') ;

            $table->timestamp('cities_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('cities_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('countries_id')->references('countries_id')->on('countries')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('cities');
    }
}
