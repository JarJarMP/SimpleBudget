<?php

class CategoriesController extends BaseController
{
	public function getIndex()
	{
		JavaScript::put(array(
	        'post_urls' => array(
				'categories' => route('categories'),
				'category_edit' => route('category_editor'),
			)
	    ));

		return View::make('pages/categories');
	}

	public function postIndex()
	{
		$response = array();

		$category_type = Input::get('expense_or_income');
		$node_action = Input::get('node_action');
		$node_data = Input::get('node_data');

		if (!empty($category_type)) {
		
			// Page load - init both trees
			if (empty($node_action)) {
				$root = $this->getRootElement($category_type);

				if (empty($root)) {
					$this->generateRootElement($category_type);
					$root = $this->getRootElement($category_type);
				}

				$category_data = array();

				foreach($root->getDescendantsAndSelf() as $descendant) {
					array_push($category_data, array(
						'id' => $descendant->id,
						'parent' => empty($descendant->parent_id) ? '#' : $descendant->parent_id,
						'text' => $descendant->name,
						'state' => array(
							'opened' => true,
						),
					));
				}

				$response = array(
					'result' => empty($category_data) ? false : $category_data,
					'result_msg' => empty($category_data) ? 'No category data in the database!' : '',
				);	

			// Handle node actions
			} else {
				Log::info('category_type: '.print_r($category_type, true));
				Log::info('node_action: '.print_r($node_action, true));
				Log::info('node_data: '.print_r($node_data, true));
			}
			
		} else {
			$response = array(
				'result' => false,
				'result_msg' => 'No category type in post data!',
			);
		}

		return Response::json($response);
	}

	private function getRootElement($type)
	{
		$result = null;

		if (in_array($type, array('expense', 'income'))) {
			switch ($type) {
				case 'expense':
					$result = ExpenseCategory::root();
					break;

				case 'income':
					$result = IncomeCategory::root();
					break;
				
				default:
					$result = null;
					break;
			}
		}

		return $result;
	}

	private function generateRootElement($type)
	{
		$root = null;

		switch ($type) {
			case 'expense':
				$root = ExpenseCategory::create(['name' => 'Expenses']);
				break;

			case 'income':
				$root = IncomeCategory::create(['name' => 'Incomes']);
				break;
			
			default:
				$root = null;
				break;
		}
		
		if ($root !== null) {
			$root->makeRoot();
			$root->parent_id = null;
			$root->save();
		}		
	}
}