@extends('layouts.main')

@section('content')
	{{ View::make('partials.header', array('right_menu' => true)) }}

	<div class="row categories-content">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Expense Categories
				</div>

				<div class="panel-body">
					<div id="expense_tree">
						{{ View::make('partials.progressbar', array('text' => 'Categories are loading')) }}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Income Categories
				</div>

				<div class="panel-body">
					<div id="income_tree">
						{{ View::make('partials.progressbar', array('text' => 'Categories are loading')) }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('page_specific_js')
    {{ HTML::script('/js/category_page.js') }}
@stop