<?php
/**
 *
 * User model 
 * 
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends BaseModel implements UserInterface, RemindableInterface {

	// This is trait for using entrust
	use HasRole; // Add this trait to your user model

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/*
   * ORM: belongs to hospital 
   */
  public function hospital()
  {
      return $this->belongsTo('Hospital');
  }
}
