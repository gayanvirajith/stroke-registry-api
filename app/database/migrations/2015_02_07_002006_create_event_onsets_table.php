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
			$table->dateTime('admission_time');
			$table->float('onset_to_admission_time');
			$table->string('modified_rankin_scale');
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
