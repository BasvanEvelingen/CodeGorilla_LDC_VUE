<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('survey_details')) {
            Schema::create('survey_details', function (Blueprint $table) {
                $table->increments('id');
                $table->string('survey_name');
                $table->integer('survey_id')->unsigned();
                $table->string('survey_type');
                $table->string('user_name');
                $table->integer('user_id')->unsigned();
                $table->string('status');
                $table->text('survey_outcome');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_details');
    }
}
