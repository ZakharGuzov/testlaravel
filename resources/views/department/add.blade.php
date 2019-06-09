@extends('template')

@section('title', 'Добавить новый отдел')

@section('content')
	<h1>Добавить новый отдел</h1>

	<form method="POST" action="/department/store">
		@csrf
		<div class="form-group">
			<label>Название отдела:</label>
			<input class="form-control" type="text" name="department" required>
		</div>
		<input class="btn btn-primary" type="submit" name="add" value="Добавить">

	</form>

@endsection