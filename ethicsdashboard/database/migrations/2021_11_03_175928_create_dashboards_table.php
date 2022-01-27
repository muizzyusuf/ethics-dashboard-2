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
            $table->text('summary')->nullable();
            $table->string('role')->nullable();
            $table->text('dilemma')->nullable();
            $table->unsignedBigInteger('ethical_issue_id');
            $table->unsignedBigInteger('utilitarianism_section_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('case_study_id');
            $table->unsignedBigInteger('stakeholder_section_id');
            $table->unsignedBigInteger('deontology_section_id');
            $table->unsignedBigInteger('virtue_section_id');
            $table->unsignedBigInteger('care_section_id');
            $table->integer('grade')->default(0);
            $table->timestamps();

            $table->foreign('ethical_issue_id')->references('id')->on('ethical_issues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utilitarianism_section_id')->references('id')->on('utilitarianism_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stakeholder_section_id')->references('id')->on('stakeholder_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deontology_section_id')->references('id')->on('deontology_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('virtue_section_id')->references('id')->on('virtue_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('care_section_id')->references('id')->on('care_sections')->onDelete('cascade')->onUpdate('cascade');
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
