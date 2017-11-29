<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('entity_id')->index()->unsigned();
            $table->integer('media_id')->index()->unsigned();
            $table->string('entity_type');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugin_entities');
    }
}
