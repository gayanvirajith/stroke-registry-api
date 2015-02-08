<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrugHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drug_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('use_antiplatelet');
			$table->boolean('use_anticoagulation');
			$table->tinyInteger('antiplatelet_status');
			$table->tinyInteger('anticoagulation_status');
			$table->boolean('thrombolysis_for_stemi');
			$table->boolean('thrombolysis_for_stroke');
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
		Schema::drop('drug_histories');
	}

}
