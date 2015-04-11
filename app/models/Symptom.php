<?php

class Symptom extends \Eloquent {

	protected $guarded = ['id'];

	public function event_onsets() {
		return $this->belongsToMany('EventOnset');
	}
}