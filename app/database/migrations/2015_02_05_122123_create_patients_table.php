<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('No name');
			$table->string('nic', 10)->default('');
			$table->string('sex', 1)->default('');
			$table->string('address_1')->default('');
			$table->string('address_2')->default('');
			$table->string('contact_no_1', 20)->default('');
			$table->string('contact_no_2', 20)->default('');
			$table->string('guardian_name')->default('');
			$table->string('guardian_contact_no_1', 20)->default('');
			$table->string('guardian_contact_no_2', 20)->default('');
			$table->date('dob')->default('0000-00-00');
			$table->tinyInteger('age')->default(0);
			$table->integer('health_care_number')->unsigned()->default(0);
			$table->tinyInteger('province')->default(0);
			$table->tinyInteger('admitted_to')->default('0.00');
			$table->integer('hospital_id')->default(0);
			$table->index('nic');
			$table->index('hospital_id');
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
		Schema::drop('patients');
	}

}
