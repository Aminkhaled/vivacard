<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('admins', function (Blueprint $table) {
            $table->bigIncrements('admins_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('admins_status',['0','1'])->default('1')->comment("0 => stopped, 1 => active ");
            $table->integer('admins_position')->default('1');
            $table->rememberToken()->nullable($value = true);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::connection('mysql')->dropIfExists('admins');
    }
}
