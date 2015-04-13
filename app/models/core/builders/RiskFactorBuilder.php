<?php

class RiskFactorBuilder
{


    /**
     * @var RiskFactor
     */
    protected $riskFactor;


    /**
     * @var array
     */
    protected $config = array();


    /**
     * Parametrized constructor with:
     *
     * @param array $config
     * @param RiskFactor $r
     * @internal param Patient $patient
     */
    public function __construct(array $config, RiskFactor $r = NULL)
    {
        $this->riskFactor = $r;
        $this->setConfig($config);
    }

    /**
     * Process some default configurations
     *
     * @param array $config
     */
    protected function setConfig(array $config)
    {
        // todo set some default values
        $defaults = array();

        $config = array_merge($defaults, $config);

        $this->config = $config;
    }

    /**
     * Build risk-factor using the supplied configuration parameters
     *
     * @return null
     */
    public function build()
    {
        foreach ($this->config as $option => $value) {
            $this->riskFactor->$option = $value;
        }
    }


    /**
     * @return Patient
     */
    public function getRiskFactor()
    {
        return $this->riskFactor;
    }

}