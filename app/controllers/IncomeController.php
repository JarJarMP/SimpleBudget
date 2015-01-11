<?php

class IncomeController extends BaseController
{
	public function getIndex()
	{
		$root = IncomeCategory::root();
		$leaves = $root->getLeaves();

		$leaf_categories = array();

		foreach ($leaves as $leaf) {
			$ancestors = $leaf->getAncestorsWithoutRoot();

			$path = '';

			foreach ($ancestors as $current) {
				$path .= $current->name.' / ';
			}

			$path .= $leaf->name;

			array_push($leaf_categories, array(
				'category_id' => $leaf->id,
				'category_path' => $path,
			));
		}

		return View::make('pages/incomes', array('leaf_categories' => $leaf_categories));
	}
}