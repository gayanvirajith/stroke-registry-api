<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOtherHeartDiseaseRiskFactorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('other_heart_disease_risk_factor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('other_heart_disease_id')->unsigned()->index();
			$table->foreign('other_heart_disease_id')->references('id')->on('other_heart_diseases')->onDelete('cascade');
			$table->integer('risk_factor_id')->unsigned()->index();
			$table->foreign('risk_factor_id')->references('id')->on('risk_factors')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('other_heart_disease_risk_factor');
	}

}
