<?php namespace App\Models;

class Event extends \BaseModel {

	protected $table = 'events';

	protected $guarded = [];

	public $rules = [];

	public static function getLastEventTime($funcionario_id, $time)
	{
		$start = (new \DateTime($time))->setTime(0,0,0);
		$end = (new \DateTime($time))->setTime(23,59,59);

		$event = Event::where('funcionario_id', $funcionario_id)
						->where('created_at', '>=', $start)
						->where('created_at', '<=', $end)
						->where('console','local')
						->where('event','<>','open')
						->where('event','<>','login')
						->where('event','<>','unlock')
						->orderBy('created_at', 'desc')
						->first();

		if ( ! isset($event))
		{
			return $time;
		}

		return $event->created_at;
	}

}