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
      Log::info("build method invoked ! - " . $this->patient->id);
      foreach ($this->config as $option => $value) {
        $status = (property_exists(get_class($this->patient), $option) === true)? "true" : "false";
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