<?php 

/**
 * Custom validations for event onset model
 *
 */

class EventOnsetValidation  {

  /**
   * Validate symtoms option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function symptomsCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, EventOnset::$initialSymptomsOptions);
  }


  /**
   * Validate presentation mode option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function presentationCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, EventOnset::$firstPresentationOptions);
  }


  /**
   * Validate transport options
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function transportOptionCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, EventOnset::$transportOptions);
  }


  /**
   * Validate oxfordshire community classification options
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function oxfordshireCommunityClassificationOptionsCheck($attribute, 
    $value, $parameters)
  {
      return array_key_exists($value, 
        EventOnset::$oxfordshireCommunityClassificationOptions);
  }


  /**
   * Validate side Of Symptoms 
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function sideOfSymptomsOptionsCheck($attribute, 
    $value, $parameters)
  {
      return array_key_exists($value, EventOnset::$sideOfSymptomsOptions);
  }
}