<?php

class BlockingList extends Eloquent {

	protected $primaryKey = 'urls';
	protected $connection = 'sdgipa';
	protected $table = 'lists';

}
