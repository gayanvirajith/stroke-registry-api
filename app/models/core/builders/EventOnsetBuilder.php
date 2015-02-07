<?php

class EventOnsetBuilder {

  /**
   * @var eventOnset
   */ 
  protected $eventOnset;


  /**
   * @var 
   */
  protected $config = array();


  /**
   * Parameterized constructor with:
   *
   * @param array $config
   * @param eventOnset $eventOnset
   */
  public function __construct(array $config, EventOnset $eventOnset = NULL) {

    $this->eventOnset = $eventOnset; 
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
   * Build the eventOnset using the supplied configuration parameters
   *
   * @return null
   */
  public function build()
  {
      foreach ($this->config as $option => $value) {
        $this->eventOnset->$option = $value;
      }
  }


  /**
   * @return eventOnset
   */
  public function getEventOnset()
  {
      return $this->eventOnset;
  }
}