<?php

class Symptom extends \Eloquent {

	protected $guarded = ['id'];


	/**
	 * Get the event onset data associated with the given symptom
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function event_onsets() {
		return $this->belongsToMany('EventOnset');
	}
}