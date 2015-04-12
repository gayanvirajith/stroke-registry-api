<?php

/**
 *
 * Event Onset model
 *
 */

class EventOnset extends BaseModel {


  /**
   * Guarded array
   *
   * @var array
   */
  protected $guarded = ['id', 'episode_id'];


  /**
   * Validation rules set
   */
  public static $rules = [
      'episode_id'                  => 'required',
      'onset_of_stroke_at'          => 'required',
      'admission_time'              => 'required',
      'onset_to_admission_time'     => 'required',
      'patient_id'                  => 'required|exists:patients,id',
  ];


  /**
   * Custom validation messages defined under validators/*.php
   */
  public static $messages = [
    'symptoms'                  => 'The symptoms field is not valid.',
  ];



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
   * ORM: belongs to patient
   */
  public function patient()
  {
      return $this->belongsTo('Patient');
  }


  /**
   * Get the symptoms associated with the corresponding patient event onset
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function symptoms() {
    return $this->belongsToMany('Symptom');
  }
}
