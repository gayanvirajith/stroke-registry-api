<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRiskFactorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('risk_factors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('antiplatelet_drug_at_the_time_of_stroke');
			$table->boolean('warfarin_at_the_time_of_stroke');
			$table->tinyInteger('past_history_of_stroke')->unsigned();
			$table->tinyInteger('hypertension')->unsigned();
			$table->tinyInteger('diabetes_mellitus')->unsigned();
			$table->tinyInteger('ischaemic_heart_disease')->unsigned();
			$table->boolean('current_smoker');
			$table->boolean('unsafe_alcohol_intake');
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
		Schema::drop('risk_factors');
	}

}
