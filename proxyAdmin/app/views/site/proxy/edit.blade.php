@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('proxy'))

@section('content')

	<div class="title">
		<h1>Departamento: {{$departamento->nome_departamento}}</h1>
		<h2>Usuário: {{$usuario->nome_usuario}}</h2>
		<br>
		<h3>Marque os itens cujo acesso dever ser LIBERADO</h1>
	</div>

	<div class="contents">
		{{Form::open(['route' => ['proxy.edit', $departamento->codigo_departamento, $usuario->codigo_usuario]])}}
		<ul class="list-group">
			@foreach($lists as $list)
				<li class="list-group-item">
					<input type="checkbox" {{ array_search($list->id, $selected) === false ? "" : "checked" }} class="prettyCheckable" value="{{$list->id}}" id="{{$list->name}}" name="group[{{$list->id}}]" data-label="{{$list->name}}" />
				</li>
			@endforeach
		</ul>	
		<button type="submit" class="btn btn-danger btn-lg">Gravar</button>
		<a href='/' class="btn btn-primary btn-lg">Cancelar</a>
		{{Form::close()}}
	</div>	
@stop