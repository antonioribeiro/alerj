@extends('layout')

@if($departamento)
	@section('breadcrumbs', Breadcrumbs::render('departamento', $departamento))
@else
	@section('breadcrumbs', Breadcrumbs::render('departamentos'))
@endif

@section('content')

	@if($departamento)
		<div class="title">
			<h1>{{$departamento->sigla_departamento}}</h1>
			<h2>{{$departamento->nome_departamento}}</h2>
			<br>
			<h3>Selecione o departamento subordinado</h1>
		</div>
	@else 
		<div class="title">
			<h1>Selecione o departamento</h1>
		</div>
	@endif

	<div class="contents">
		<ul>	
			@foreach($departamentos as $departamento)
				<li>
					<a href="{{URL::route('departamento',[$parent,$departamento['codigo_departamento']])}}">@if($departamento['sigla_departamento'])<strong>{{$departamento['sigla_departamento']}}</strong> - @endif {{$departamento['nome_departamento']}}</a>
				</li>
			@endforeach
		</ul>
	</div>

@stop