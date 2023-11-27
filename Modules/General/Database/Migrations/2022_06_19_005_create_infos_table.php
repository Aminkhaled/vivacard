<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('infos', function (Blueprint $table) {
            $table->bigIncrements('infos_id');
            $table->string('infos_key',30)->nullable();
            $table->enum('infos_status',['0','1'])->default('1')->comment("0 => stopped, 1 => active ");
            $table->integer('infos_position')->default(1);

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
        Schema::connection('mysql')->dropIfExists('infos');
    }
}
