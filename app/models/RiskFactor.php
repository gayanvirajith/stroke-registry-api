<?php

class RiskFactor extends \Eloquent {

	/**
	 * Guarded array
	 *
	 * @var array
     */
	protected $guarded = ['id'];

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