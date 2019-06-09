@extends('template')

@section('title', 'Ошибка')

@section('content')
	<h1>Ошибка</h1>

	<div class="card">
		<div class="card-body">
			<div class="alert alert-danger">
			  {{ $err }}
			</div>
		</div>
	</div>

@endsection