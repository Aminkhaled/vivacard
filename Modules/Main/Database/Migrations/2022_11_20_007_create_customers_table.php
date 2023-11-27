<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('customers', function (Blueprint $table) {
            $table->bigIncrements('customers_id');
            $table->string('customers_name')->nullable();
            $table->string('customers_country_code')->nullable();
            $table->string('customers_phone')->nullable();
            $table->string('customers_email')->nullable();
            $table->unsignedBigInteger('countries_id')->nullable();
            $table->date('customers_birthdate')->nullable();
            $table->enum('phone_verified',['0','1'])->default('0')->comment('0 => not verified , 1 => verified');
            $table->enum('email_verified',['0','1'])->default('0')->comment('0 => not verified , 1 => verified');
            $table->string('password')->nullable();
            $table->string('customers_image')->nullable();
            $table->enum('customers_gender',['male','female'])->nullable();
            $table->enum('customers_status',['0','1'])->default('1')->comment('0 => stopped , 1 => active');
            $table->string('device_token')->nullable() ;
            $table->string('remember_token')->nullable() ;
            $table->string('email_verification_code')->nullable();

            $table->timestamp('customers_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('customers_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('countries_id')->references('countries_id')->on('countries')->onUpdate('set null')->onDelete('set null');

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
        Schema::dropIfExists('customers');
    }
}
