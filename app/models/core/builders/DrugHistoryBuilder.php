<?php

class DrugHistoryBuilder {

  /**
   * @var drugHistory
   */ 
  protected $drugHistory;


  /**
   * @var 
   */
  protected $config = array();


  /**
   * Parametrized constructor with:
   *
   * @param array $config
   * @param DrugHistory $drugHistory
   */
  public function __construct(array $config, DrugHistory $drugHistory = NULL) {

    $this->drugHistory = $drugHistory; 
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
   * Build the drugHistory using the supplied configuration parameters
   *
   * @return null
   */
  public function build()
  {
      foreach ($this->config as $option => $value) {
        $this->drugHistory->$option = $value;
      }
  }


  /**
   * @return drugHistory
   */
  public function getDrugHistory()
  {
      return $this->drugHistory;
  }
}