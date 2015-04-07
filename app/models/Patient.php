<?php

/**
 * Patient model
 */
class Patient extends BaseModel {

    const EDU_NO_FORMAL = 1;
    const EDU_PRIMARY_LEVEL = 2;
    const EDU_ORDINARY_LEVEL = 3;


    /*
     * constant values used for education mapping
     */
    const EDU_ADVANCED_LEVEL = 4;
    const EDU_UNIVERSITY_LEVEL = 5;
    const EDU_OTHER = 6;
    const EMP_UNEMPLOYED = 1;
    const EMP_MANUAL_WORKER = 2;
    const EMP_SELF_EMPLOYED = 3;


    /*
     * constant values used for employment mapping
     */
    const EMP_PRIVATE_SECTOR = 4;
    const EMP_GOVERNMENT_SECTOR = 5;
    const EMP_RETIRED = 6;
    const EMP_STUDENT = 7;
    const LEVEL_INDEPENDENCE = 1;
    const LEVEL_SLIGHT_DISABILITY = 2;
    const LEVEL_MODERATE_DISABILITY = 3;


    /*
     * constant values used for level of independence prior to Stroke onset:
     */
    const LEVEL_MODERATE_TO_SEVERE_DISABILITY = 4;
    const LEVEL_SEVERE_DISABILITY = 5;
    const LIVES_WITH_FAMILY = 1;
    const LIVES_ALONE = 2;
    const LIVES_INSTITUTIONALIZED = 3;


    /*
     * constant values used for living arrangements
     * MARITAL
     */
    const LIVES_OTHER = 4;
    const MARITAL_STATE_SINGLE = 1;
    const MARITAL_STATE_MARRIED = 2;
    const MARITAL_STATE_WIDOW = 3;
    const MARITAL_STATE_DIVORCE = 4;


    /*
     * constant values used for martial status
     */
    const ETHNICITY_SINHALA = 1;
    const ETHNICITY_MUSLIM = 2;
    const ETHNICITY_TAMIL = 3;


    /*
     * constant values used for ethnicity
     */
    const ETHNICITY_OTHER = 4;
    const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';
    const POSTPARTUM_FIRST_TRIMESTER = 1;


    /*
     * constant values used for sex
     */
    const POSTPARTUM_SECOND_TRIMESTER = 2;
    const POSTPARTUM_THIRD_TRIMESTER = 3;


    /*
     * constant values used for postpartum
     */
    const POSTPARTUM_LESS_THAN_6_WEEKS = 4;
    const DEXTERITY_RIGHT = 1;
    const DEXTERITY_LEFT = 2;
    const DEXTERITY_AMBIDEXTROUS = 3;



    /*
     * constant values used for provinces
     */
    const PROVINCE_CENTRAL = 1;
    const PROVINCE_EASTERN = 2;
    const PROVINCE_NORTH_CENTRAL = 3;
    const PROVINCE_NORTHERN = 4;
    const PROVINCE_NORTH_WESTERN = 5;
    const PROVINCE_SABARAGAMUWA = 6;
    const PROVINCE_SOUTHERN = 7;
    const PROVINCE_UVA = 8;
    const PROVINCE_WESTERN = 9;



    /*
     * constant values used for admitted options
     */
    const ADMITTED_TO_MEDICAL_WARD = 1;
    const ADMITTED_TO_STROKE_UNIT = 2;
    const ADMITTED_TO_NEUROSURGERY_WARD = 3;
    const ADMITTED_TO_NEUROLOGY_WARD = 4;


    /**
     * Validation rules set
     */
    public static $rules = array(
        'name'                  => 'required|min:4|max:255',
        'nic'                   => 'required|min:10|max:10',
        'sex'                   => 'required|in:M,F',
        'age'                   => 'min:1|max:199',
        'dob'                   => 'date',
        'health_care_number'    => 'numeric',
        'province'              => 'numeric|min:1|province',
        'admitted_to'           => 'required|numeric|min:1|admittedTo',
        'hospital_id'           => 'required|exists:hospitals,id',
    );
    /**
     * Custom validation messages defined under validators/*.php
     */
    public static $messages = [
        'province'            => 'The province field is not valid.',
        'admitted_to'         => 'The admitted-to field is not valid.',
    ];

    public static $educationOptions = [
        self::EDU_NO_FORMAL        => 'No formal',
        self::EDU_PRIMARY_LEVEL    => 'Primary level',
        self::EDU_ORDINARY_LEVEL   => 'Ordinary level',
        self::EDU_ADVANCED_LEVEL   => 'Advanced level',
        self::EDU_UNIVERSITY_LEVEL => 'University',
        self::EDU_OTHER            => 'Other'
    ];


    /*
     * Education options
     */
    public static $employmentOptions = [
        self::EMP_UNEMPLOYED        => 'Unemployed',
        self::EMP_MANUAL_WORKER     => 'Manual worker',
        self::EMP_SELF_EMPLOYED     => 'Self-employed',
        self::EMP_PRIVATE_SECTOR    => 'Private sector',
        self::EMP_GOVERNMENT_SECTOR => 'Government sector',
        self::EMP_RETIRED           => 'Retired',
        self::EMP_STUDENT           => 'Student'
    ];


    /*
     * Employment options
     */
    public static $levelOfIndependenceOptions = [
        self::LEVEL_INDEPENDENCE        => 'Independence',
        self::LEVEL_SLIGHT_DISABILITY   => 'Slight disability',
        self::LEVEL_MODERATE_DISABILITY => 'Moderate disability',
        self::LEVEL_MODERATE_TO_SEVERE_DISABILITY
                                        => 'Moderate to severe disability',
        self::LEVEL_SEVERE_DISABILITY   => 'Severe disability'
    ];


    /*
     * Level independence options
     */
    public static $livingArrangementOptions = [
        self::LIVES_WITH_FAMILY       => 'Lives with family',
        self::LIVES_ALONE             => 'Lives alone',
        self::LIVES_INSTITUTIONALIZED => 'Institutionalized',
        self::LIVES_OTHER             => 'Other'
    ];


    /*
     * Living arrangement options
     */
    public static $maritalStatusOptions = [
        self::MARITAL_STATE_SINGLE  => 'Single',
        self::MARITAL_STATE_MARRIED => 'Married',
        self::MARITAL_STATE_WIDOW   => 'Widow',
        self::MARITAL_STATE_DIVORCE => 'Divorce'
    ];


    /*
     * Martial status options
     */
    public static $ethnicityOptions = [
        self::ETHNICITY_SINHALA => 'Sinhala',
        self::ETHNICITY_MUSLIM  => 'Muslim',
        self::ETHNICITY_TAMIL   => 'Tamil',
        self::ETHNICITY_OTHER   => 'Other'
    ];


    /*
     * Postpartum options
     */
    public static $postpartumOptions = [
        self::POSTPARTUM_FIRST_TRIMESTER   => 'First trimester',
        self::POSTPARTUM_SECOND_TRIMESTER  => 'Second trimester',
        self::POSTPARTUM_THIRD_TRIMESTER   => 'Third trimester',
        self::POSTPARTUM_LESS_THAN_6_WEEKS => 'Postpartum (<6 weeks)'
    ];


    /*
     * Dexterity options
     */
    public static $dexterityOptions = [
        self::DEXTERITY_RIGHT        => 'Right',
        self::DEXTERITY_LEFT         => 'Left',
        self::DEXTERITY_AMBIDEXTROUS => 'Ambidextrous'
    ];


    /*
     * Province options
     */
    public static $provincesOptions = [
        self::PROVINCE_CENTRAL       => 'Central',
        self::PROVINCE_EASTERN       => 'Eastern',
        self::PROVINCE_NORTH_CENTRAL => 'North central',
        self::PROVINCE_NORTHERN      => 'Northern',
        self::PROVINCE_NORTH_WESTERN => 'North western',
        self::PROVINCE_SABARAGAMUWA  => 'Sabaragamuwa',
        self::PROVINCE_SOUTHERN      => 'Southern',
        self::PROVINCE_UVA           => 'Uva',
        self::PROVINCE_WESTERN       => 'Western'
    ];



    /*
     *
     * Admitted to
     */
    public static $admittedTo = [
        self::ADMITTED_TO_MEDICAL_WARD        => 'Medical ward/Medical ICU',
        self::ADMITTED_TO_STROKE_UNIT         => 'Stroke unit',
        self::ADMITTED_TO_NEUROSURGERY_WARD   => 'Neurosurgery
        ward/Neurosurgery ICU',
        self::ADMITTED_TO_NEUROLOGY_WARD         => 'Neurology ward/Neurology
         ICU',
    ];


    /**
     * Guarded array
     */
    protected $guarded = ['id', 'hospital_id'];


    /*
     * ORM: belongs to a hospital
     */
    public function hospital()
    {
        return $this->belongsTo('Hospital');
    }


    /*
     * ORM: belongs to event onset
     */
    public function eventOnset()
    {
        return $this->hasOne('EventOnset');
    }


    /*
     * ORM: belongs to drug history
     */
    public function drugHistory()
    {
        return $this->hasOne('DrugHistory');
    }

}
