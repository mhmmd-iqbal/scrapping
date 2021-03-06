<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_trainings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->boolean('brand')->default(false);
            $table->boolean('size')->default(false);
            $table->boolean('model')->default(false);
            $table->integer('brand_id')
                ->unsigned()
                ->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('brand_id')
            //     ->references('id')
            //     ->on('brands')
            //     ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_trainings');
    }
}
