<?php

class BaseModel extends \Eloquent {
  
  /**
   * Base validate method. Used to validate input data 
   * 
   * @return Validator  
   */
  public static function validate($data) {
    return Validator::make($data, static::$rules, static::$messages);
  }

}