<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("user_id");
            $table->date("borrow_date");
            $table->date("return_date")->nullable();

            $table->foreign('book_id')->references('id')->on('book');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrows');
    }
};
