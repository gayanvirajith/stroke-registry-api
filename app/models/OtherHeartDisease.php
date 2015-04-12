<?php

class OtherHeartDisease extends \Eloquent {

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