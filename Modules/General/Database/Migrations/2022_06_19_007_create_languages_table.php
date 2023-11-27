<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('languages', function (Blueprint $table) {
            $table->tinyIncrements('languages_id');
            $table->string('name');
            $table->string('locale',2);
            $table->string('dir',3)->comment(" 'ltr' => left to right, 'rtl' => right to left ");
            $table->enum('status',['0','1'])->default('1')->comment("0 => stopped, 1 => active ");
            $table->tinyInteger('position')->default('1');
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
        Schema::connection('mysql')->dropIfExists('languages');
    }
}
