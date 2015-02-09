<?php

/**
 *
 * Drug history model
 *
 */

class DrugHistory extends BaseModel {

  /*
   * Guarded array 
   */
	protected $guarded = ['id'];


  /**
   * Validation rules set
   */
  public static $rules = [
    'antiplatelet_status'          => 'numeric|antiplatelet', 
    'anticoagulation_status'       => 'numeric|anticoagulation', 
  ];


  /**
   * Custom validation messages defined under validators/*.php
   */
  public static $messages = [
    'antiplatelet'        => 'The antiplatelet field is not valid.',
    'anticoagulation'     => 'The anticoagulation field is not valid.',
  ];

  /*
   * constant values used for `antiplatelet agents`
   */
  const ANTIPLATELET_ASPIRIN      = 1;
  const ANTIPLATELET_DIPYRIDAMOLE = 2;
  const ANTIPLATELET_CLOPIDOGREL  = 3;
  const ANTIPLATELET_PRASUGREL    = 4;
  const ANTIPLATELET_CILOSTAZOL   = 5;

  
  /*
   * constant values for `anticoagulation indications`
   */
  const ANTICOAGULATION_ATRIAL_FIBRILATION        = 1;
  const ANTICOAGULATION_PROSTHETIC_VALVE          = 2;
  const ANTICOAGULATION_INTRA_CARDIAC_THROMBUS    = 3;
  const ANTICOAGULATION_CONGESTIVE_HEART_FAILURE  = 4;
  const ANTICOAGULATION_VENOUS_THROMBOSIS         = 5;
  const ANTICOAGULATION_THROMBOPHILIA             = 6;
  const ANTICOAGULATION_OTHER                     = 7;


  /*
   * antiplatelet agents options
   */
  public static $antiplateletAgentOptions = [
    self::ANTIPLATELET_ASPIRIN      => 'Aspirin',
    self::ANTIPLATELET_DIPYRIDAMOLE => 'Dipyridamole',
    self::ANTIPLATELET_CLOPIDOGREL  => 'Dipyridamole',
    self::ANTIPLATELET_PRASUGREL    => 'Prasugrel',
    self::ANTIPLATELET_CILOSTAZOL   => 'Cilostazol',
  ];


  /*
   * anticoagulation indications options
   */
  public static $anticoagulationIndicationOptions = [
    self::ANTICOAGULATION_ATRIAL_FIBRILATION        => 'Atrial Fibrilation',
    self::ANTICOAGULATION_PROSTHETIC_VALVE          => 'Prosthetic valve',
    self::ANTICOAGULATION_INTRA_CARDIAC_THROMBUS    => 'Intra cardiac thrombus',
    self::ANTICOAGULATION_CONGESTIVE_HEART_FAILURE  => 'Congestive heart failure',
    self::ANTICOAGULATION_VENOUS_THROMBOSIS         => 'Venous thrombosis',
    self::ANTICOAGULATION_THROMBOPHILIA             => 'Thrombophilia',
    self::ANTICOAGULATION_OTHER                     => 'Other'
  ];
  

  /*
   * ORM: belongs to patient
   */
  public function patient()
  {
      return $this->belongsTo('Patient');
  }

}
