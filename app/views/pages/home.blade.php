@extends('layouts.main')

@section('content')
	{{ View::make('partials.header') }}

	<div class="row">
		<div class="col-md-12">
			<h3>HomePage</h3>

			<a href="{{ route('logout') }}">
				{{ Form::button('Logout', array('class' => 'btn btn-warning')) }}
			</a>
		</div>
	</div>
@stop