<?php 

/**
 * Custom validations for drug history model
 *
 */

class DrugHistoryValidation  {

  /**
   * Validate antiplatelet agents options
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function antiplateletCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, DrugHistory::$antiplateletAgentOptions);
  }


  /**
   * Validate anticoagulation indications options
   *
   * @param array $attribute
   * @param String $value
   * @param array $parameters
   */
  public function anticoagulationCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, DrugHistory::$anticoagulationIndicationOptions);
  }


}