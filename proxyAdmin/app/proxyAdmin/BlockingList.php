<?php

class BlockingList extends BaseModel {

	protected $primaryKey = 'id';
	protected $connection = 'sdgipa';
	protected $table = 'lists';
	protected $guarded = [];

	public function urls()
	{
		return $this->hasMany('BlockingUrl', 'list_id');
	}

	public function getUrlsAsStr()
	{
		$urls = $this->urls()->get(['url'])->toArray();

		$return = '';

		foreach($urls as $url)
		{
			$return .= $url['url'] . "\n";
		}

		return $return;
	}

	public function putUrlsAsStr($urls)
	{
		BlockingUrl::where('list_id', $this->id)->delete();

		foreach($urls as $url)
		{
			$url = strtolower(trim($url));

			$a = BlockingUrl::where('list_id', $this->id)->where('url', $url)->first();

			if ($a === NULL)
			{
				BlockingUrl::create([
								'list_id' => $this->id,
								'url' => $url,
								'created_at' => new \Carbon\Carbon, 
								'updated_at' => new \Carbon\Carbon,			
							]);

				$updated = true;
			}
		}

		if($updated)
		{
			Cache::flush();
		}
	}

}
