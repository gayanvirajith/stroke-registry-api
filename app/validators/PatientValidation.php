<?php

class PatientValidation {

  public function provinceCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$provincesOptions);
  }

  public function maritialStatusCheck($attribute, $value, $parameters)
  {
      return array_key_exists($value, Patient::$maritialStatusOptions);
  }

}