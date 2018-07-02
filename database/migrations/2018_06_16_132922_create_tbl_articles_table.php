<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('articles')) {

            Schema::create('articles', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';

                $table->increments('id');
                $table->integer('category_id', false, true);
                $table->integer('user_id', false, true);
                $table->string('title', 140);
                $table->text('content');
                $table->timestamps();
                $table->dateTime('published_at')->nullable();
                $table->smallInteger('status', false, true);
                $table->softDeletes();

                $table->unique('title');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
