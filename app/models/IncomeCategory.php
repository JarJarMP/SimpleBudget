<?php

use Baum\Node;

class IncomeCategory extends Node
{
	protected $table = 'income_categories';

	use \SimpleBudget\ModelTrait\CategoryTrait;
}