<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('advertisements_id');
            $table->string('advertisements_name',255)->nullable();
            $table->integer('advertisements_position')->default(1);
            $table->string('advertisements_color',7)->nullable();
            $table->enum('advertisements_status',['0','1'])->default('1')->comment("0 => stopped, 1 => active ");
            $table->string('advertisements_view_page',30)->nullable();
            $table->string('advertisements_link_type',100)->nullable();
            $table->string('advertisements_link_value',255)->nullable();
            $table->timestamp('advertisements_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('advertisements_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::connection('mysql')->dropIfExists('advertisements');
    }
}
