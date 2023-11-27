<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('faqs', function (Blueprint $table) {
            $table->bigIncrements('faqs_id');
            $table->integer('faqs_position')->default(1);
            $table->enum('faqs_status',['0','1'])->default('1')->comment("0 => stopped, 1 => active ");
         
            $table->timestamp('faqs_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('faqs_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::connection('mysql')->dropIfExists('faqs');
    }
}
