<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntityRssfeedPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_rssfeed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id')->index();
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
            $table->unsignedBigInteger('rssfeed_id')->index();
            $table->foreign('rssfeed_id')->references('id')->on('rssfeeds')->onDelete('cascade');
            $table->unique(['entity_id', 'rssfeed_id']);
            $table->integer('start');
            $table->integer('end');
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
        Schema::dropIfExists('entity_rssfeed');
    }
}
