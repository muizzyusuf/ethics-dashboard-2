<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoralLawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moral_laws', function (Blueprint $table) {
            $table->id();
            $table->string('moral_law');
            $table->unsignedBigInteger('option_id');
            $table->string('universalizability')->nullable();
            $table->text('uni_explain')->nullable();
            $table->string('consistency')->nullable();
            $table->text('con_explain')->nullable();
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moral_laws');
    }
}
