<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventOnsetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_onsets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('episode_id');
			$table->dateTime('onset_of_stroke_at');
			$table->tinyInteger('first_presentation_to'); 
			$table->dateTime('admission_time');
			$table->float('onset_to_admission_time');
			$table->tinyInteger('transport_mode');
			$table->boolean('stroke_occur_in_hospital');
			$table->string('symptoms');
			$table->tinyInteger('oxfordshire_classification');
			$table->tinyInteger('side_of_symptoms');
			$table->string('modified_rankin_scale');
			$table->string('barthel_index');
			$table->string('gcs');
			$table->integer('patient_id');
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
		Schema::drop('event_onsets');
	}

}
