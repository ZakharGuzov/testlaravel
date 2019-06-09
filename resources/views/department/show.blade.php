@extends('template')

@section('title', 'Список отделов')

@section('content')
	<h1>Список отделов</h1>

	<div class="card">
		<div class="card-header">
			<a href="department/add" class="btn btn-primary" role="button">Добавить</a>
		</div>
		<div class="card-body">
			<table class="table">
				<tr>
					<th>Отдел</th>
					<th>Количество сотрудников</th>
					<th>максимальная з/п</th>
				</tr>
				@foreach ($departments as $department)
					<tr>
						<td>{{ $department->department_name }}</td>
						<td>{{ $department->count }}</td>
						<td>{{ $department->max }}</td>
						<td>
							<a href="/department/delete/{{ $department->id }}" class="btn btn-danger float-right" role="button">Удалить</a>
							<a href="/department/edit/{{ $department->id }}" class="btn btn-primary float-right" role="button">Редактировать</a>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@endsection