<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->unsigned();
            $table->integer('updater_id')->unsigned();
            $table->timestamps();
            $table->datetime('deleted_at');
            $table->boolean('is_active')->default(0); //0:Active 1:Deactive
            $table->integer('model_id')->unsigned()->nullable()->index()->comment('Model id');
            $table->string('model_type')->nullable()->index()->comment('Model Name');
            $table->string('media_name')->comment('Media Name');
            $table->string('mime_type')->comment('Media Type')->nullable();
            $table->longText('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
