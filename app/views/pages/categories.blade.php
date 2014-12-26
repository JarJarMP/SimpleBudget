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
						<ul>
							<li class="jstree-open">Expenses
								<ul>
									<li class="jstree-open">Cat 1</li>
									<li class="jstree-open">Cat 2</li>
								</ul>
							</li>
						</ul>
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
						<ul>
							<li class="jstree-open">Incomes
								<ul>
									<li class="jstree-open">Cat 1</li>
									<li class="jstree-open">Cat 2</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function () { 
			$('#expense_tree, #income_tree').jstree({
				'core' : {
					'check_callback' : true
				},
				'types' : {
					'default' : {
						'icon' : 'glyphicon glyphicon-plus'
					}
				},
				'plugins' : [ 'types', 'contextmenu', 'dnd', 'unique' ]
			}); 
		});
	</script>
@stop