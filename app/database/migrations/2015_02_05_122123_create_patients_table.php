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
			$table->string('stroke_id')->unique();
			$table->tinyInteger('bht_number');
			$table->integer('hospital_id');
			$table->string('name');
			$table->tinyInteger('age');
			$table->date('dob');
			$table->string('nic', 10);
			$table->string('sex', 1);
			$table->tinyInteger('marital_status');
			$table->boolean('pregnant'); // if femail, 
			$table->tinyInteger('pregnant_status'); // if femail, 
			$table->tinyInteger('ethnicity'); 
			$table->tinyInteger('dexterity'); 
			$table->string('address_1'); 
			$table->string('address_2');
			$table->tinyInteger('province');  
			$table->string('contact_no_1', 20);
			$table->string('contact_no_2', 20);
			$table->string('guardian_name');
			$table->string('guardian_contact_no_1', 20);
			$table->string('guardian_contact_no_2', 20);
			$table->tinyInteger('education');  
			$table->tinyInteger('employement');  
			$table->tinyInteger('level_of_independence');  
			$table->tinyInteger('living_arrangement');  
			$table->index('stroke_id');  
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
