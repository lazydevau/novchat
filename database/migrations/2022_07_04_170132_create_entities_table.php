

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->mediumtext('name')->unique();
            $table->mediumtext('type');
            $table->tinyInteger('ischecked')->default('0');
            $table->tinyInteger('isgroup')->default('0');
            $table->integer('related');
            $table->longtext('wikidata');
            $table->text('description');
            $table->timestamps();
        });
        Schema::table('entities', function (Blueprint $table) {
            $table->enum('notification_type', ['none', 'daily', 'weekly'])->default('none');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}

