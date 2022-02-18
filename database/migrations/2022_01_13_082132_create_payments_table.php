<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->unsigned();

            //شماره تراکنش
            $table->string('transactionId');
            //شماره پیگیری
            $table->string('track_number')->nullable();
            //نام بانک پذیرنده
            $table->string('bank_name')->nullable();
            //نوع اشتراک  یک ماهانه،شش ماهه،یکساله
            $table->string('subscription_type')->comment('1=>One month,6=Six month,12=Twelve months');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
