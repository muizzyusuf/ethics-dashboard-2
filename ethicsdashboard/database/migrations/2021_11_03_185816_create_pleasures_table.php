<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePleasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pleasures', function (Blueprint $table) {
            $table->id();
            $table->integer('pleasure');
            $table->text('explanation');
            $table->string('level');
            $table->unsignedBigInteger('consequence_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('stakeholder_id');
            $table->timestamps();

            $table->foreign('consequence_id')->references('id')->on('consequences')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pleasures');
    }
}
