<?php

use Baum\Node;

class ExpenseCategory extends Node
{
	protected $table = 'expense_categories';

	use \SimpleBudget\ModelTrait\CategoryTrait;
}