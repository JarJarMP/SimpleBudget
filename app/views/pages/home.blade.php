@extends('layouts.main')

@section('content')
	{{ View::make('partials.header', array('right_menu' => true)) }}

	<div class="row home-page-content">
		<div class="col-md-3 text-center">
			<a href="{{ route('expenses') }}" class="huge-button hover-bg-green">Expenses</a>
		</div>

		<div class="col-md-3 text-center">
			<a href="{{ route('incomes') }}" class="huge-button hover-bg-green">Incomes</a>
		</div>

		<div class="col-md-3 text-center">
			<a href="{{ route('charts') }}" class="huge-button hover-bg-green">Charts</a>
		</div>

		<div class="col-md-3 text-center">
			<a href="{{ route('categories') }}" class="huge-button hover-bg-green">Categories</a>
		</div>
	</div>
@stop