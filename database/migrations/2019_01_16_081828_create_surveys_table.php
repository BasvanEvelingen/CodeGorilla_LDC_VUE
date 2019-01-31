<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('surveys')) {
            Schema::create('surveys', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('user_id')->unsigned();
                $table->longtext('survey');
                $table->timestamps();
                $table->softDeletes();
                $table->index(['deleted_at']);
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
        Schema::dropIfExists('surveys');
    }
}
