@extends('template')

@section('title', 'Добавить нового сотрудника')

@section('content')
	<h1>Добавить нового сотрудника</h1>

	<form method="POST" action="/employee/store" id="add-employee">
		@csrf
		<div class="form-group">
			<label>Имя:</label>
			<input class="form-control" type="text" name="name" required>
		</div>
		<div class="form-group">
			<label>Фамилия:</label>
			<input class="form-control" type="text" name="sername" required>
		</div>
		<div class="form-group">
			<label>Отчество:</label>
			<input class="form-control" type="text" name="patronymic">
		</div>
		<div class="form-group form-check">
    		<label class="form-check-label">
				<input class="form-check-input" type="radio" name="sex" value="male" checked>Мужской
			</label>
		</div>
		<div class="form-group form-check">
    		<label class="form-check-label">
				<input class="form-check-input" type="radio" name="sex" value="female">Женский
			</label>
		</div>
		<div class="form-group">
			<label>Зарплата:</label>
			<input class="form-control" type="text" name="salary">
		</div>

		@foreach ($departments as $department)
			<div class="form-group form-check">
    			<label class="form-check-label">
					<input type="checkbox" name="department[]" value="{{ $department->id }}">
				{{ $department->department_name }}
				</label>
			</div>
		@endforeach

		<input class="btn btn-primary" type="submit" name="add" value="Дабавить">

	</form>

	<script type="text/javascript">
		
		$('#add-employee').on("submit", function (e) {
			var arr = $(this).serialize().toString();
			if(arr.indexOf("department") < 0){
				e.preventDefault();
				alert("Выберите отдел");
			}
		});
	</script>

@endsection