<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->text('option');
            $table->unsignedBigInteger('ethical_issue_id');
            $table->unsignedBigInteger('virtue_id')->nullable();
            $table->string('imperative')->nullable();
            $table->timestamps();

            $table->foreign('ethical_issue_id')->references('id')->on('ethical_issues')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('options');
    }
}
