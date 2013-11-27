<?php

use BlockingList as Model;

class ListsController extends BaseController {

	private $lists;

	public function __construct(Model $lists)
	{
		$this->lists = $lists;
	}

	public function index()
	{
		return View::make('site.lists.index')
				->with('lists', $this->lists->all() );
	}

	public function create()
	{
		return View::make('site.lists.create');
	}

	public function edit($id)
	{
		$list = $this->lists->findOrFail($id);

		return View::make('site.lists.edit')
				->with('list', $list)
				->with('urls', $list->getUrlsAsStr());
	}

	public function update($id)
	{
		$urls = array_filter(explode("\n", Input::get('urls')));

		$list = $this->lists->findOrFail($id);

		$list->name = strtolower(Input::get('name'));
		$list->save();

		$list->putUrlsAsStr($urls);

		return Redirect::route('lists.index');
	}

	public function store()
	{
		$urls = array_filter(explode("\n", Input::get('urls')));

		$list = Model::create([
						'name' => strtolower(Input::get('name')),
						'created_at' => new \Carbon\Carbon, 
						'updated_at' => new \Carbon\Carbon,			
					]);

		$list->putUrlsAsStr($urls);

		return Redirect::route('lists.index');
	}
}


// facebook.com
// facebook.com.br
// facebook.fr
// pt-br.facebook.com
// www.facebook.com
// www.facebook.com.br
// www.facebook.fr
