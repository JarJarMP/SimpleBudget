<?php

class CategoriesController extends BaseController
{
	public function getIndex()
	{
		return View::make('pages/categories');
	}
}