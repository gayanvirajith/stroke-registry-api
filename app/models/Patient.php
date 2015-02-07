<?php

/**
 *
 * Patient model 
 * 
 */

class Patient extends BaseModel {
	
  /**
   * Guarded array 
   */
  protected $guarded = ['id', 'stroke_id', 'hospital_id'];


  /**
   * Validation rules set
   */
  public static $rules = array(
    'name' => 'required|min:4|max:255',
    'nic' => 'required|min:10|max:10',
    'sex' => 'required|in:M,F',
    'age' => 'min:1|max:150',
    'dob' => 'date',
    'bht_number' => 'numeric',
    'pregnant' => 'in:0,1',
    'province' => 'numeric|min:1|province',
    'marital_status' => 'numeric|min:1|marital',
    'pregnant_status' => 'numeric|postpartum',
    'ethnicity' => 'numeric|ethinicity',
    'dexterity' => 'numeric|dexterity',
    'education' => 'numeric|education',
    'employement' => 'numeric|employment',
    'level_of_independence' => 'numeric|levelOfIndependence',
    'living_arrangement' => 'numeric|livingArrangement',
  );


  /**
   * Custom validation messages defined under validators/*.php
   */
  public static $messages = [
    'province'                => 'The province field is not valid.',
    'marital'                 => 'The marital status is not valid.',
    'postpartum'              => 'The postpartum status is not valid.',
    'ethnicity'               => 'The ethnicity status is not valid.',
    'dexterity'               => 'The dexterity status is not valid.',
    'education'               => 'The education status is not valid.',
    'employment'              => 'The employement status is not valid.',
    'levelOfIndependence'     => 'The level of independence status is not valid.',
    'livingArrangement'       => 'The living arrangement status is not valid.',
  ];


  /*
   * constant values used for education mapping
   */
  const EDU_NO_FORMAL         = 1;
  const EDU_PRIMARY_LEVEL     = 2;
  const EDU_ORDINARY_LEVEL    = 3;
  const EDU_ADVANCED_LEVEL    = 4;
  const EDU_UNIVERSITY_LEVEL  = 5;
  const EDU_OTHER             = 6;


  /*
   * constant values used for employment mapping
   */
  const EMP_UNEMLPLOYED       = 1;
  const EMP_MANUAL_WORKER     = 2;
  const EMP_SELF_EMPLOYED     = 3;
  const EMP_PRIVATE_SECTOR    = 4;
  const EMP_GOVERNMENT_SECTOR = 5;
  const EMP_RETIRED           = 6;
  const EMP_STUDENT           = 7;


  /*
   * constant values used for level of independance prior to Stroke oset:
   */
  const LEVEL_INDEPENDENCE                  = 1;
  const LEVEL_SLIGHT_DISABILITY             = 2;
  const LEVEL_MODERATE_DISABILITY           = 3;
  const LEVEL_MODERATE_TO_SEVERE_DISABILITY = 4;
  const LEVEL_SEVERE_DISABILITY             = 5;

  
  /*
   * constant values used for living arrangements
   */

  const LIVES_WITH_FAMILY       = 1;
  const LIVES_ALONE             = 2;
  const LIVES_INSTITUTIONALIZED = 3;
  const LIVES_OTHER             = 4;

  
  /*
   * constant values used for martial status
   */
  const MARITIAL_STATE_SINGLE      = 1;
  const MARITIAL_STATE_MARRIED     = 2;
  const MARITIAL_STATE_WIDOW       = 3;
  const MARITIAL_STATE_DIVORCE     = 4;


  /*
   * constant values used for ethinicity
   */
  const ETHNICITY_SINHALA        = 1;
  const ETHNICITY_MUSLIM         = 2;
  const ETHNICITY_TAMIL          = 3;
  const ETHNICITY_OTHER          = 4;

  
  /*
   * constant values used for sex
   */
  const SEX_MALE    = 'M';
  const SEX_FEMAILE = 'F';


  /*
   * constant values used for postpartum 
   */
  const POSTPARTUM_FIRST_TRIMESTER = 1;
  const POSTPARTUM_SECOND_TRIMESTER = 2;
  const POSTPARTUM_THIRD_TRIMESTER = 3;
  const POSTPARTUM_LESS_THAN_6_WEEKS = 4;


  /*
   * constant values used for dexterity
   */
  const DEXTERITY_RIGHT         = 1;
  const DEXTERITY_LEFT          = 2;
  const DEXTERITY_AMBIDEXTROUS  = 3;


  /*
   * constant values used for provinces
   */
  const PROVINCE_CENTRAL        = 1;
  const PROVINCE_EASTERN        = 2;
  const PROVINCE_NORTH_CENTRAL  = 3;
  const PROVINCE_NORTHERN       = 4;
  const PROVINCE_NORTH_WESTERN  = 5;
  const PROVINCE_SABARAGAMUWA   = 6;
  const PROVINCE_SOUTHERN       = 7;
  const PROVINCE_UVA            = 8;
  const PROVINCE_WESTERN        = 9;


  /*
   * Education options 
   */
  public static $educationOptions = [
    self::EDU_NO_FORMAL         => 'No formal',
    self::EDU_PRIMARY_LEVEL     => 'Primary level',
    self::EDU_ORDINARY_LEVEL    => 'Ordinary level',
    self::EDU_ADVANCED_LEVEL    => 'Advanced level',
    self::EDU_UNIVERSITY_LEVEL  => 'University',
    self::EDU_OTHER             => 'Other'
  ];

  
  /*
   * Employement options
   */
  public static $employmentOptions = [
    self::EMP_UNEMLPLOYED       => 'Unemploed',
    self::EMP_MANUAL_WORKER     => 'Manual worker',
    self::EMP_SELF_EMPLOYED     => 'Self-employed',
    self::EMP_PRIVATE_SECTOR    => 'Private sector',
    self::EMP_GOVERNMENT_SECTOR => 'Government sector',
    self::EMP_RETIRED           => 'Retired',
    self::EMP_STUDENT           => 'Student'
  ];


  /*
   * Level indenpendence options
   */
  public static $levelOfIndependenceOptions = [
    self::LEVEL_INDEPENDENCE                  => 'Independence',
    self::LEVEL_SLIGHT_DISABILITY             => 'Slight disability',
    self::LEVEL_MODERATE_DISABILITY           => 'Moderate disability',
    self::LEVEL_MODERATE_TO_SEVERE_DISABILITY 
      => 'Moderate to severe disability',
    self::LEVEL_SEVERE_DISABILITY             => 'Severe disability'
  ];


  /*
   * Living arrangement options
   */
  public static $livingArrangementOptions = [
    self::LIVES_WITH_FAMILY       => 'Lives with family',
    self::LIVES_ALONE             => 'Lives alone',
    self::LIVES_INSTITUTIONALIZED => 'Institutionalized',
    self::LIVES_OTHER             => 'Other'
  ];


  /*
   * Martial status options
   */
  public static $maritialStatusOptions = [
    self::MARITIAL_STATE_SINGLE      => 'Single',
    self::MARITIAL_STATE_MARRIED     => 'Married',
    self::MARITIAL_STATE_WIDOW       => 'Widow',
    self::MARITIAL_STATE_DIVORCE     => 'Divorce'
  ];


  /*
   * Ethinicity options
   */
  public static $ethinicityOptions = [
    self::ETHNICITY_SINHALA        => 'Sinhala',
    self::ETHNICITY_MUSLIM         => 'Muslim',
    self::ETHNICITY_TAMIL          => 'Tamil',
    self::ETHNICITY_OTHER          => 'Other'
  ];


  /*
   * Postpartum options
   */
  public static $postpartumOptions = [
    self::POSTPARTUM_FIRST_TRIMESTER    => 'First trimester',
    self::POSTPARTUM_SECOND_TRIMESTER   => 'Second trimester',
    self::POSTPARTUM_THIRD_TRIMESTER    => 'Third trimester',
    self::POSTPARTUM_LESS_THAN_6_WEEKS  => 'Portpartum (<6 weeks)'
  ];


  /*
   * Dexterity options
   */
  public static $dexterityOptions = [
    self::DEXTERITY_RIGHT         => 'Right',
    self::DEXTERITY_LEFT          => 'Left',
    self::DEXTERITY_AMBIDEXTROUS  => 'Ambidextrous'
  ];


  /*
   * Provinces options
   */
  public static $provincesOptions = [
    self::PROVINCE_CENTRAL        => 'Central',
    self::PROVINCE_EASTERN        => 'Eastern',
    self::PROVINCE_NORTH_CENTRAL  => 'North central',
    self::PROVINCE_NORTHERN       => 'Northern',
    self::PROVINCE_NORTH_WESTERN  => 'North western',
    self::PROVINCE_SABARAGAMUWA   => 'Sabaragamuwa',
    self::PROVINCE_SOUTHERN       => 'Southern',
    self::PROVINCE_UVA            => 'Uva',
    self::PROVINCE_WESTERN        => 'Western' 
  ];


  /*
   * ORM: belongs to a hospital
   */
  public function hospital()
  {
      return $this->belongsTo('Hospital');
  }


  /*
   * ORM: belongs to eventoset
   */
  public function eventOnset() {
    return $this->hasOne('EventOnset');
  }
}
