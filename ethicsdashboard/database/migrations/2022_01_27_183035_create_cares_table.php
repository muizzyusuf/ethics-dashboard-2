<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cares', function (Blueprint $table) {
            $table->id();
            $table->integer('attentiveness');
            $table->integer('competence');
            $table->integer('responsiveness');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('stakeholder_id');
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cares');
    }
}
