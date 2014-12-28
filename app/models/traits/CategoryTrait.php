<?php

namespace SimpleBudget\ModelTrait;

// Category CRUD
trait CategoryTrait
{
	private $name_length = 100; // int - contains the maximum length of the category name
	
	public function createNode($name, $parent_id)
	{
		$parent_node = $this->getNodeById($parent_id);

		$new_node = $this->createNodeByName($name);
		$new_node->makeChildOf($parent_node);

		return $new_node->id;
	}

	public function renameNode($node_id, $new_name)
	{
		$this->cleanCategoryName($new_name);

		$node = $this->getNodeById($node_id);
		$node->name = $new_name;
		$node->save();
	}

	public function deleteNode($node_id)
	{
		$node = $this->getNodeById($node_id);
		$node->delete();
	}

	public function moveNode($node_id, $new_parent_id, $position)
	{
		$node = $this->getNodeById($node_id);
		$new_parent = $this->getNodeById($new_parent_id);
		$new_position = (int)$position;

		$node->makeFirstChildOf($new_parent);
		if ($new_position > 0) {
			for ($i = 0; $i < $new_position; $i++) { 
				$node->moveRight();
			}
		}
	}

	private function getNodeById($node_id)
	{
		return self::where('id', '=', (int)$node_id)->first();
	}

	private function createNodeByName($name)
	{
		$this->cleanCategoryName($name);
		return self::create(array('name' => $name));
	}

	private function cleanCategoryName(&$name)
	{
		$name = substr($name, 0, $this->name_length);
	}
}