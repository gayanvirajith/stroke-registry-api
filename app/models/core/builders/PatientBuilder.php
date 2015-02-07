<?php

class PatientBuilder {

  /**
   * @var patient
   */ 
  protected $patient;


  /**
   * @var 
   */
  protected $config = array();


  /**
   * Parameterized constructor with:
   *
   * @param array $config
   * @param Patient $patient
   */
  public function __construct(array $config, Patient $patient = NULL) {

    $this->patient = $patient; 
    $this->setConfig($config);
  }

  /**
   * Process some default configurations
   * 
   * @param array $config
   */
  protected function setConfig(array $config) {
    // todo set some default values
    $defaults = array();

    $config =  array_merge($defaults, $config);

    $this->config = $config;
  }

  /**
   * Build the patient using the supplied configuration parameters
   *
   * @return null
   */
  public function build()
  {
      foreach ($this->config as $option => $value) {
        $this->patient->$option = $value;
      }
  }


  /**
   * @return Patient
   */
  public function getPatient()
  {
      return $this->patient;
  }
}