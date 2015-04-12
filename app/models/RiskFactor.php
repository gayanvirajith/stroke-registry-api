<?php

class RiskFactor extends \Eloquent {

	/**
	 * Guarded array
	 *
	 * @var array
     */
	protected $guarded = ['id'];


    /**
     * Validation rules set
     *
     * @var array
     */
    public static $rules = [
        'past_history_of_stroke'        => 'required',
        'hypertension'                  => 'required',
        'diabetes_mellitus'                  => 'required',
        'ischaemic_heart_disease'                  => 'required',
        'patient_id'                    => 'required|exists:patients,id',
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