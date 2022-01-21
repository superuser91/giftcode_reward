<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftcodeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giftcode_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('giftcode_id');
            $table->string('code');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->boolean('is_shared')->default(false);
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
        Schema::dropIfExists('giftcode_records');
    }
}
