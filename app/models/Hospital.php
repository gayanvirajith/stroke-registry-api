<?php

class Hospital extends \Eloquent {
	
  protected $guarded = ['id'];

  public function patients()
  {
      return $this->hasMany('Patient');
  }
}