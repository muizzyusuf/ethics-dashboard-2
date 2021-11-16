<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('ethical_issue_id');
            $table->unsignedBigInteger('utilitarianism_section_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('case_study_id');
            $table->unsignedBigInteger('stakeholder_section_id');
            $table->timestamps();

            $table->foreign('ethical_issue_id')->references('id')->on('ethical_issues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utilitarianism_section_id')->references('id')->on('utilitarianism_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stakeholder_section_id')->references('id')->on('stakeholder_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('case_study_id')->references('id')->on('case_studies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboards');
    }
}
