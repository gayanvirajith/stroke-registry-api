<?php

/**
 *
 * Event Onset model
 *
 */

class EventOnset extends BaseModel {

  /*
   * Guarded array 
   */
  protected $guarded = ['id', 'episode_id'];


  /*
   * constant values used for `first presentation mapping`
   */
  const FIRST_PRESENTATION_TO_HOSPITAL   = 1;
  const FIRST_PRESENTATION_TO_CONSULTANT = 2;
  const FIRST_PRESENTATION_TO_AYURVEDIC  = 3;
  const FIRST_PRESENTATION_TO_GP         = 3;


  /*
   * constant values used for `mode of transport`
   */
  const MODE_OF_TRANSPORT_TRANSFERRED_FROM_ANOTHER_HOSPITAL = 1;
  const MODE_OF_TRANSPORT_PERSONAL_VEHICLE                  = 2;
  const MODE_OF_TRANSPORT_TAXI                              = 3;
  const MODE_OF_TRANSPORT_PUBLIC                            = 4;
  const MODE_OF_TRANSPORT_AMBULANCE                         = 5;
  const MODE_OF_TRANSPORT_OTHER                             = 6;


  /*
   * constant values used for `Initial symptoms`
   */
  const SYMPTOM_WEAKNESS              = 1;
  const SYMPTOM_SPEECH_DISTURBANCE    = 2;
  const SYMPTOM_SENSORY_SYMPTOMS      = 3;
  const SYMPTOM_DYSPHAGIA             = 4;
  const SYMPTOM_MONOCULAR_BLINDNESS   = 5;
  const SYMPTOM_FIELD_DEFECT          = 6;
  const SYMPTOM_BRAINSTEM             = 7;
  const SYMPTOM_CEREBELLAR            = 8;
  const SYMPTOM_COGNITIVE_SYMPTOMS    = 9;
  const SYMPTOM_SEIZURE               = 10;
  const SYMPTOM_HEADACHE              = 11;


  /*
   * constant values used for `oxfordshire community stroke project
   */
  const TACS    = 1;
  const PACS    = 2;
  const POCS    = 3;
  const LACUNAR = 4;


  /*
   * constant values used for `side of symptoms`
   */
  const SIDE_SYMPTOM_LEFT      = 1;
  const SIDE_SYMPTOM_RIGHT     = 2;
  const SIDE_SYMPTOM_BILATERAL = 3;


  /*
   * First presentation options 
   */
  public static $firstPresentationOptions = [
    self::FIRST_PRESENTATION_TO_HOSPITAL   => 'Hospital',
    self::FIRST_PRESENTATION_TO_CONSULTANT => 'Consultant',
    self::FIRST_PRESENTATION_TO_AYURVEDIC  => 'Ayurvedic',
    self::FIRST_PRESENTATION_TO_GP         => 'GP',
  ];


  /*
   * Mode of transport options
   */
  public static $transportOptions = [
    self::MODE_OF_TRANSPORT_TRANSFERRED_FROM_ANOTHER_HOSPITAL =>
      'Another hospital',
    self::MODE_OF_TRANSPORT_PERSONAL_VEHICLE  => 'Personal vehicle',
    self::MODE_OF_TRANSPORT_TAXI              => 'Taxi',
    self::MODE_OF_TRANSPORT_PUBLIC            => 'Public',
    self::MODE_OF_TRANSPORT_AMBULANCE         => 'Ambulance',
    self::MODE_OF_TRANSPORT_OTHER             => 'Other'
  ];


  /*
   * Initialize symptoms options
   */
  public static $initialSymptomsOptions = [
    self::SYMPTOM_WEAKNESS              => 'Weakness',
    self::SYMPTOM_SPEECH_DISTURBANCE    => 'Speech disturbance',
    self::SYMPTOM_SENSORY_SYMPTOMS      => 'Sensory symptoms',
    self::SYMPTOM_DYSPHAGIA             => 'Dysphagia',
    self::SYMPTOM_MONOCULAR_BLINDNESS   => 'Monocular blindness',
    self::SYMPTOM_FIELD_DEFECT          => 'Field defect',
    self::SYMPTOM_BRAINSTEM             => 'Brainstem',
    self::SYMPTOM_CEREBELLAR            => 'Cerebellar',
    self::SYMPTOM_COGNITIVE_SYMPTOMS    => 'Cognitive symptoms',
    self::SYMPTOM_SEIZURE               => 'Seizure',
    self::SYMPTOM_HEADACHE              => 'Headache'
  ];


  /*
   * oxfordshire community options
   */
  public static $oxfordshireCommunityClassificationOptions = [
    self::TACS    => 'TACS',
    self::PACS    => 'PACS',
    self::POCS    => 'POCS',
    self::LACUNAR => 'LACUNAR'
  ];


  /*
   * Side of symptoms options
   */
  public static $sideOfSymptomsOptions = [
    self::SIDE_SYMPTOM_LEFT      => 'Left',
    self::SIDE_SYMPTOM_RIGHT     => 'Right',
    self::SIDE_SYMPTOM_BILATERAL => 'Bilateral'
  ];


  /*
   * ORM: belongs to patient
   */
  public function patient()
  {
      return $this->belongsTo('Patient');
  }
}
