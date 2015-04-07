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
			$table->string('name');
			$table->string('nic', 10);
			$table->string('sex', 1);
			$table->string('address_1');
			$table->string('address_2');
			$table->string('contact_no_1', 20);
			$table->string('contact_no_2', 20);
			$table->string('guardian_name');
			$table->string('guardian_contact_no_1', 20);
			$table->string('guardian_contact_no_2', 20);
			$table->date('dob');
			$table->tinyInteger('age');
			$table->integer('health_care_number');
			$table->tinyInteger('province');
			$table->tinyInteger('admitted_to');
			$table->integer('hospital_id');
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
