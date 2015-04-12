<?php

/**
 * Patient model
 */
class Patient extends BaseModel {

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
