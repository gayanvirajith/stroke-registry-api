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
			$table->integer('episode_id')->default(0);
			$table->dateTime('onset_of_stroke_at')->default('0000-00-00 00:00:00');
			$table->dateTime('admission_time')->default('0000-00-00 00:00:00');
			$table->float('onset_to_admission_time')->default('0.00');
			$table->string('modified_rankin_scale')->default('');
			$table->integer('patient_id')->default(0);
            $table->timestamps();
            $table->index('patient_id');
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
