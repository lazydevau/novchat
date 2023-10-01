

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssfeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rssfeeds', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->text('source');
            $table->text('category');
            $table->integer('groupa')->default('0');
            $table->text('title');
            $table->text('link');
            $table->text('description');
            $table->text('guid');
            $table->text('pubDate');
            $table->text('timestamp');
            $table->text('content');
            $table->timestamp('tagged_at');
            $table->text('lang');
//            $table->timestamp('date');
            $table->timestamps();
            $table->unique(["source", "title"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rssfeeds');
    }
}

