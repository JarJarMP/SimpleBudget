<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>Simple Budget</title>

	<link rel="stylesheet" type="text/css" href="{{ URL::asset('lib/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('lib/bootstrap/dist/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/simple-budget.css') }}">
</head>
<body>
	<div class="container">
		@yield('content')

		{{ View::make('partials.footer') }}
	</div>
</body>
</html>