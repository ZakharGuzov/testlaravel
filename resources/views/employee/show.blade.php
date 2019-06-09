@extends('template')

@section('title', 'Список сотрудников')

@section('content')
	<h1>Список сотрудников</h1>

	<div class="card">
		<div class="card-header">
			<a href="employee/add" class="btn btn-primary" role="button">Добавить</a>
		</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<th>Имя</th>
					<th>Фамилия</th>
					<th>Отчество</th>
					<th>Пол</th>
					<th>Заработная плата</th>
					<th>Отдел</th>
				</tr>
			@foreach ($employees as $employee)
				<tr>
					<td>{{ $employee->name }}</td>
					<td>{{ $employee->sername }}</td>
					<td>{{ $employee->patronymic }}</td>
					<td>{{ $employee->sex }}</td>
					<td>{{ $employee->salary }}</td>
					<td>
					{{ $departments = '' }}
					@foreach ($joins as $join)
						@if ($join->employee_id == $employee->employee_id)
							@if ($departments == '')
								{{$departments = $join->department_name}}
							@else
								{{', ' . $join->department_name}}
							@endif
						@endif
					@endforeach
					</td>
					<td>
						<a href="/employee/delete/{{ $employee->employee_id }}" class="btn btn-danger float-right" role="button">Удалить</a>
						<a href="/employee/edit/{{ $employee->employee_id }}" class="btn btn-primary float-right" role="button">Редактировать</a>
					</td>
				</tr>
			@endforeach
			</table>
		</div>
	</div>

@endsection