<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/tabler.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<title>@yield('title')</title>
</head>
<body>

	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="/" class="nav-link">Сетка</a>
			</li>
			<li class="nav-item">
				<a href="/department" class="nav-link">Отделы</a>
			</li>
			<li class="nav-item">
				<a href="/employee" class="nav-link">Сотрудники</a>
			</li>
		</ul>	
	</nav>
	
	<div class="container">

	@yield('content')

	</div>

</body>
</html>