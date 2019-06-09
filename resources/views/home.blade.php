@extends('template')

@section('title', 'Сетка')

@section('content')
	<h1>Сетка</h1>

	<div class="card">
		<div class="card-body">
			<table class="table">
			@foreach ($grids as $grid)
				<tr>
				@foreach ($grid as $val)
					<td>{{ $val }}</td>
				@endforeach
				</tr>
			@endforeach
			</table>
		</div>
	</div>

@endsection