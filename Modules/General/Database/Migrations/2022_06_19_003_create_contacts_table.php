<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('contacts', function (Blueprint $table) {
            $table->bigIncrements('contacts_id');
            $table->unsignedBigInteger('orders_id')->nullable();
            $table->unsignedBigInteger('customers_id')->nullable();
            $table->unsignedBigInteger('providers_id')->nullable();
            $table->text('contacts_mobiles')->nullable();
            $table->string('contacts_facebook')->nullable();
            $table->string('contacts_twitter')->nullable();
            $table->string('contacts_instagram')->nullable();
            $table->string('contacts_snapchat')->nullable();
            $table->string('contacts_youtube')->nullable();
            $table->string('contacts_whatsapp',20)->nullable();
            $table->string('contacts_email',50)->nullable();
            $table->timestamp('contacts_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('contacts_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::connection('mysql')->dropIfExists('contacts');
    }
}
