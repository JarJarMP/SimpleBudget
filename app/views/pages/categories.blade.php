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
  								style="width: 100%">
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
  								style="width: 100%">
    							<span class="sr-only">Categories are loading</span>
  							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function () { 
			
			function init_category_tree(category_type){
				$.post(
					"{{ route('categories') }}",
					{'expense_or_income' : category_type},
					function (data) {
						var $category_tree = $('#' + category_type + '_tree');
						$category_tree.empty();

						if (typeof(data.result) != 'undefined' && typeof(data.result_msg) != 'undefined') {
							if (data.result != false) {
								$category_tree.jstree({ 
									'core' : {
										'data' : data.result,
										'check_callback' : true
									},
									'types' : {
										'default' : {
											'icon' : false
										}
									},
									'plugins' : [ 'types', 'contextmenu', 'dnd', 'unique' ]
								});

							} else {
								$category_tree.html(data.result_msg);
							}
						} else {
							$category_tree.html('AJAX request failed!');
						}					
					},
					'json'
				);
			}
			
			init_category_tree('expense');
			init_category_tree('income');
		});
	</script>
@stop