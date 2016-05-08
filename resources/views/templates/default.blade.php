<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Chatty</title>
			<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="shortcut icon" href="{{asset('icon/chat.png')}}" />

	</head>
	<body>

@include('templates.partials.navigation')

	<div class="container">
		@include('templates.partials.alerts')	
		@yield('content')	
	</div>

	</body>
</html>