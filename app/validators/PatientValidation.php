<?php

/**
 * Custom validations for patient model
 *
 */

class PatientValidation {

  /**
   * Validate province option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function provinceCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$provincesOptions);
  }


  /**
   * Validate marital status option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function maritialStatusCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$maritialStatusOptions);
  }


  /**
   * Validate education option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function educationCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$educationOptions);
  }


  /**
   * Validate employement option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function employmentCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$employmentOptions);
  }  


  /**
   * Validate level of indendence option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function levelOfIndependenceCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$levelOfIndependenceOptions);
  }


  /**
   * Validate living arrangement option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function livingArrangementCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$livingArrangementOptions);
  }


  /**
   * Validate ethnicity option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function ethinicityCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$ethinicityOptions);
  }


  /**
   * Validate postpartum option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function postpartumCheck($attribute, $value, $parameters)
  {
      return $value == 0 || array_key_exists($value, Patient::$postpartumOptions);
  }


  /**
   * Validate dexterity option
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function dexterityCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$dexterityOptions);
  }
}