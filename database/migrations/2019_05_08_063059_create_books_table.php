<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 500);
            $table->string('isbn')->unique();
            $table->string('author', 200);
            $table->string('language', 200);
            $table->string('publisher')->nullable();
            $table->integer('genre', 100);
            $table->double('price')->nullable();
            $table->date('reldate')->date();
            $table->string('image')->nullable();
            $table->tinyInteger('issued')->nullable();
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
        Schema::dropIfExists('books');
    }
}
