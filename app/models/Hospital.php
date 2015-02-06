<?php

/**
 *
 * Hospital model 
 * 
 */

class Hospital extends BaseModel {
	
  protected $guarded = ['id'];

  /*
   * ORM: Hospital has many patients
   */
  public function patients()
  {
      return $this->hasMany('Patient');
  }

  /*
   * ORM: Hospital has many users
   */
  public function users()
  {
      return $this->hasMany('Users');
  }
  
}