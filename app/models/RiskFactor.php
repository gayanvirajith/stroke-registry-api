<?php

class RiskFactor extends BaseModel {

	/**
	 * Guarded array
	 *
	 * @var array
     */
	protected $guarded = ['id'];

    /*
     * Constant values for past history of stroke
     */
    const HISTORY_OF_OTHER_DISEASE_YES = 1;
    const HISTORY_OF_OTHER_DISEASE_NO = 2;
    const HISTORY_OF_OTHER_DISEASE_DO_NOT_KNOW = 3;
    const HISTORY_OF_OTHER_DISEASE_NEWLY_DIAGNOSED = 4;


    /**
     * Validation rules set
     *
     * @var array
     */
    public static $rules = [
        'past_history_of_stroke'        => 'required',
        'hypertension'                  => 'required',
        'diabetes_mellitus'             => 'required',
        'ischaemic_heart_disease'       => 'required',
    ];


    /**
     * Past history of stroke options
     *
     * @var array
     */
    public static $pastHistoryOfStrokeOptions = [
        self::HISTORY_OF_OTHER_DISEASE_YES  => 'Yes',
        self::HISTORY_OF_OTHER_DISEASE_NO   => 'No',
        self::HISTORY_OF_OTHER_DISEASE_DO_NOT_KNOW   => 'Do not know',
    ];


    /**
     * Hypertension options
     *
     * @var array
     */
    public static $hypertensionOptions = [
        self::HISTORY_OF_OTHER_DISEASE_YES => 'Yes',
        self::HISTORY_OF_OTHER_DISEASE_NO => 'NO',
        self::HISTORY_OF_OTHER_DISEASE_NEWLY_DIAGNOSED => 'Newly diagnosed',
    ];



    



    /**
     * Custom validation messages defined under validators/*.php
     */
    public static $messages = [

    ];

	/**
	 * Get other heart diseases associated with the corresponding patient
	 * risk factor
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function otherHeartDiseases() {
		return $this->belongsToMany('OtherHeartDisease');
	}
}