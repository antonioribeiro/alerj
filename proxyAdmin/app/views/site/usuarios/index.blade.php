@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('usuarios', $departamento))

@section('content')

	<div class="title">
		<h1>{{$departamento->sigla_departamento}}</h1>
		<h2>{{$departamento->nome_departamento}}</h2>
		<br>
		<h3>Selecione o Usuário</h1>
	</div>

	<div class="contents">
		<ul>	
			@foreach($usuarios as $usuario)
				<li>
					<a href="{{URL::route('proxy',[$departamento['codigo_departamento'], $usuario['codigo_usuario']])}}">{{$usuario['nome_usuario']}} ({{$usuario['nome_windows_usuario']}})</a>
				</li>
			@endforeach
		</ul>
	</div>	
@stop