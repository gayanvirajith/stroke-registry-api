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
			$table->boolean('antiplatelet_drug_at_the_time_of_stroke')->default(false);
			$table->boolean('warfarin_at_the_time_of_stroke')->default(false);
			$table->tinyInteger('past_history_of_stroke')->unsigned()->default(0);
			$table->tinyInteger('hypertension')->unsigned()->default(0);
			$table->tinyInteger('diabetes_mellitus')->unsigned()->default(0);
			$table->tinyInteger('ischaemic_heart_disease')->unsigned()->default(0);
			$table->boolean('current_smoker')->default(false);
			$table->boolean('unsafe_alcohol_intake')->default(false);
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
		Schema::drop('risk_factors');
	}

}
