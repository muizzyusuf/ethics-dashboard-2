<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakeholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->string('stakeholder');
            $table->text('interests');
            $table->unsignedBigInteger('stakeholder_section_id');
            $table->unsignedBigInteger('virtue_id')->nullable();
            $table->timestamps();

            $table->foreign('stakeholder_section_id')->references('id')->on('stakeholder_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('virtue_id')->references('id')->on('virtues')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stakeholders');
    }
}
