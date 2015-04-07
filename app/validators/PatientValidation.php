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
     * @return bool
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
     * @return bool
     */
  public function martialStatusCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$maritalStatusOptions);
  }


    /**
     * Validate education option
     *
     * @param array $attribute
     * @param String $value
     * @param array $parameters
     * @return bool
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
     * @return bool
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
     * @return bool
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
     * @return bool
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
     * @return bool
     */
  public function ethnicityCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$ethnicityOptions);
  }


    /**
     * Validate postpartum option
     *
     * @param array $attribute
     * @param String $value
     * @param array $parameters
     * @return bool
     */
  public function postpartumCheck($attribute, $value, $parameters)
  {
      return $value == 0 || array_key_exists($value, Patient::$postpartumOptions);
  }


    /**
     * Validate admitted-to option
     *
     * @param array $attribute
     * @param String $value
     * @param array $parameters
     * @return bool
     */
  public function admittedCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$admittedTo);
  }
}