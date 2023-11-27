<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('contact_us_id');
            $table->string('contact_us_name',100);
            $table->string('contact_us_phone',20);
            $table->string('contact_us_email',200);
            $table->unsignedBigInteger('customers_id')->nullable();
            //$table->enum('contact_us_type',['0','1'])->default('1')->comment("'0 => Complaint, 1 => contact_us'");
            $table->enum('contact_us_status',['0','1'])->comment('0 => "new" , 1=>"done"');
            $table->text('contact_us_message')->nullable();
            $table->timestamp('contact_us_created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('contact_us_updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::connection('mysql')->dropIfExists('contact_us');
    }
}
