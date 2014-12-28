<?php

class CategoriesController extends BaseController
{
	private $category_model; // String - contains the ExpenseCategory or the IncomeCategory model name

	private $root_names; // Array - contains the category root nodes names

	public function __construct()
	{
		$this->category_model = '';
		$this->root_names = array(
			'expense' => 'Expenses',
			'income' => 'Incomes',
		);
	}

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
				$root = $this->getCategoryRootElement($category_type);

				if (empty($root)) {
					$this->generateCategoryRootElement($category_type);
					$root = $this->getCategoryRootElement($category_type);
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
				$response = $this->handleNodeAction($category_type, $node_action, $node_data);
			}
			
		} else {
			$response = array(
				'result' => false,
				'result_msg' => 'No category type in post data!',
			);
		}

		return Response::json($response);
	}

	private function getCategoryRootElement($type)
	{
		$category_model = $this->getCategoryModelName($type);
		return $category_model::root();
	}

	private function generateCategoryRootElement($type)
	{
		$category_model = $this->getCategoryModelName($type);
		
		$root = $category_model::create(array('name' => $this->root_names[$type]));
		$root->makeRoot();
		$root->parent_id = null;
		$root->save();
	}

	private function getCategoryModelName($type)
	{
		$this->setCategoryObject($type);
		return $this->category_model;
	}

	private function setCategoryObject($category_type)
	{
		switch ($category_type) {
			case 'expense':
				$this->category_model = 'ExpenseCategory';
				break;

			case 'income':
				$this->category_model = 'IncomeCategory';
				break;
			
			default:
				throw new Exception('Not existing category type! - CategoriesController/setCategoryObject');
				break;
		}
	}

	private function handleNodeAction($category_type, $node_action, $node_data)
	{
		$result = array();

		$category_model = $this->getCategoryModelName($category_type);
		$category_model_object = new $category_model;

		switch ($node_action) {
			case 'create_node':
				$new_id = $category_model_object->createNode($node_data['node']['text'], $node_data['parent']);
				$result = array(
					'result' => array('new_id' => $new_id),
					'result_msg' => 'Creating node was successfull',
				);
				break;
		
			case 'rename_node':
				$category_model_object->renameNode($node_data['node']['id'], $node_data['text']);
				break;

			case 'delete_node':
				$category_model_object->deleteNode($node_data['node']['id']);
				break;

			case 'move_node':
				$category_model_object->moveNode($node_data['node_id'], $node_data['parent'], $node_data['position']);
				break;
				
			default:
				$result = array(
					'result' => false,
					'result_msg' => 'Not specified node action!',
				);
				break;
		}

		return $result;
	}
}