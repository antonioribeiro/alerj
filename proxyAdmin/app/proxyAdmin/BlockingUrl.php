<?php

class BlockingUrl extends BaseModel {

	protected $primaryKey = 'id';
	protected $connection = 'sdgipa';
	protected $table = 'urls';
	protected $guarded = [];

	public function blockingList()
	{
		return $this->belongsTo('BlockingList', 'list_id');
	}

}
