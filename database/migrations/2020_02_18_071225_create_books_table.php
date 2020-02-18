<?php

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('genre_id');
            $table->index('author_id');
            $table->index('genre_id');
            $table->foreign('author_id')->references('id')->on((new Author())->getTable())->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on((new Genre())->getTable())->onDelete('cascade');

            $table->timestamp('published_at');
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
