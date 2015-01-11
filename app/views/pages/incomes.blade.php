@extends('layouts.main')

@section('content')
	{{ View::make('partials.header', array('right_menu' => true)) }}

	<?php $leaf_categories = empty($leaf_categories) ? null : $leaf_categories; ?>
	{{ View::make('partials.expense_income_common', array('title' => 'Incomes', 'leaf_categories' => $leaf_categories)) }}
@stop