@extends('layouts.main')

@section('content')
	{{ View::make('partials.header') }}

	<div class="row">
		<div class="col-md-4 login-form">
			<h3>Register</h3>

			<?php // Errors ?>
			<?php $error_data = $errors->all(); ?>
			@if (!empty($error_data))
				<div class="login-errors">
					@foreach ($error_data as $error)
						<p class="bg-danger">{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<?php // Form ?>
			{{ Form::open() }}

				<div class="form-group">
					{{ Form::label('email', 'E-mail Address') }}
					{{ Form::text('email', null, array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::submit('Register', array('class' => 'btn btn-success')) }}
				</div>

			{{ Form::close() }}
		</div>

		<?php // Login link ?>
		<div class="col-md-5 col-md-offset-1 register-link">
			<h3>Go back to Login page</h3>
			<a href="{{ route('login') }}">
				{{ Form::button('Login', array('class' => 'btn btn-primary')) }}
			</a>
		</div>
	</div>
@stop