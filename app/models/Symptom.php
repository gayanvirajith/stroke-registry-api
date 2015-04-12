<?php

class Symptom extends \Eloquent {


	/**
	 * Guarded array
	 *
	 * @var array
     */
	protected $guarded = ['id'];


	/**
	 * Get the event onset data associated with the given symptom
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function eventOnsets() {
		return $this->belongsToMany('EventOnset');
	}
}