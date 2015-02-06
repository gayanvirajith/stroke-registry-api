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
    self::FIRST_PRESENTATION_TO_HOSPITAL   => '',
    self::FIRST_PRESENTATION_TO_CONSULTANT => '',
    self::FIRST_PRESENTATION_TO_AYURVEDIC  => '',
    self::FIRST_PRESENTATION_TO_GP         => '',
  ];

}