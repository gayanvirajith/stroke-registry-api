<?php

class OtherHeartDisease extends \Eloquent {

	/**
	 * Guarded array
	 *
	 * @var array
     */
	protected $guarded = ['id'];

	/**
	 * Get the risk factor data associated with the given other heart disease
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function riskFactors() {
		return $this->belongsToMany('RiskFactor');
	}
}