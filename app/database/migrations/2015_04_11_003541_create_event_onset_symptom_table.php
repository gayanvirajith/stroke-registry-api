<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventOnsetSymptomTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_onset_symptom', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_onset_id')->unsigned()->index();
			$table->foreign('event_onset_id')->references('id')->on('event_onsets')->onDelete('cascade');
			$table->integer('symptom_id')->unsigned()->index();
			$table->foreign('symptom_id')->references('id')->on('symptoms')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_onset_symptom');
	}

}
