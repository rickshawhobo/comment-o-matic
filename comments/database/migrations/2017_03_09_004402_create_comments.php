<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('commentables', function (Blueprint $table) {
            $table->string('commentable_type');
            $table->integer('commentable_id')->unsigned()->index();
            $table->integer('comment_id')->unsigned()->index();

        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->string('taggable_type');
            $table->integer('taggable_id')->unsigned()->index();
            $table->integer('tag_id')->unsigned()->index();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentables');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');

    }
}
