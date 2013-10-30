@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('departamentos'))

@section('content')

	<div class="title">
		<h1>Selecione o departamento</h1>
	</div>
	<div class="contents">
		<ul>	
			@foreach($departamentos as $departamento)
				<li>
					<a href="{{URL::route('departamento',[$departamento['codigo_departamento']])}}"><strong>{{$departamento['sigla_departamento']}}</strong> - {{$departamento['nome_departamento']}}</a>
				</li>
			@endforeach
		</ul>
	</div>

@stop

