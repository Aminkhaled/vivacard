<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('contact_translations', function (Blueprint $table) {
            $table->bigIncrements('contacts_trans_id');
            $table->unsignedBigInteger('contacts_id');
            $table->string('locale',2)->nullable();
            $table->text('contacts_text')->nullable();
            $table->text('contacts_address')->nullable();
            $table->foreign('contacts_id')->references('contacts_id')->on('contacts')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::connection('mysql')->dropIfExists('contact_translations');
    }
}
