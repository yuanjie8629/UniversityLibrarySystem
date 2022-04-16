<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->string("author");
            $table->string("publisher");
            $table->json("categories");
            $table->integer("pages");
            $table->string("image");
            $table->enum("status", ["AVAILABLE", "BORROWED", "LOST"]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
