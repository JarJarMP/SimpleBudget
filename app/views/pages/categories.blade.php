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
						<div class="progress">
							<div 
								class="progress-bar progress-bar-striped active" 
								role="progressbar" 
								aria-valuenow="100" 
								aria-valuemin="0" 
								aria-valuemax="100" 
								style="width: 100%"
							>
								<span class="sr-only">Categories are loading</span>
							</div>
						</div>
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
						<div class="progress">
							<div 
								class="progress-bar progress-bar-striped active" 
								role="progressbar" 
								aria-valuenow="100" 
								aria-valuemin="0" 
								aria-valuemax="100" 
								style="width: 100%"
							>
								<span class="sr-only">Categories are loading</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('page_specific_js')
    {{ HTML::script('/js/category_page.js') }}
@stop