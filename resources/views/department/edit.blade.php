@extends('template')

@section('title', 'Редактирование отдела')

@section('content')
	<h1>Редактирование отдела</h1>

	<form method="POST" action="/department/update/{{ $id }}">
		@csrf
		<div class="form-group">
			<label>Название отдела:</label>
			<input class="form-control" type="text" name="department" value="{{ $department_name }}" required>
		</div>
		<input class="btn btn-primary" type="submit" name="add" value="Изменить">
	</form>

@endsection