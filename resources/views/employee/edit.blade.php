@extends('template')

@section('title', 'Редактирование сотрудника')

@section('content')
	<h1>Редактирование сотрудника</h1>

	<form method="POST" action="/employee/update/{{ $id }}">
		@csrf
		<div class="form-group">
			<label>Имя:</label>
			<input class="form-control" type="text" name="name" value="{{ $name }}" required>
		</div>
		<div class="form-group">
			<label>Фамилия:</label>
			<input class="form-control" type="text" name="sername" value="{{ $sername }}" required>
		</div>
		<div class="form-group">
			<label>Отчество:</label>
			<input class="form-control" type="text" name="patronymic" value="{{ $patronymic }}">
		</div>
		<div class="form-group form-check">
    		<label class="form-check-label">
				<input class="form-check-input" type="radio" name="sex" value="male"  {{ $male }}>Мужской
			</label>
		</div>
		<div class="form-group form-check">
    		<label class="form-check-label">
				<input class="form-check-input" type="radio" name="sex" value="female" {{ $female }}>Женский
			</label>
		</div>
		<div class="form-group">
			<label>Зарплата:</label>
			<input class="form-control" type="text" name="salary" value="{{ $salary }}">
		</div>

		@foreach ($departments as $department)
			<div class="form-group form-check">
    			<label class="form-check-label">
					<input type="checkbox" name="{{ $department->id }}" value="{{ $department->id }}" {{ $department->check }}>
				{{ $department->department_name }}
				</label>
			</div>
		@endforeach

		<input class="btn btn-primary" type="submit" name="add" value="Изменить">

	</form>

@endsection