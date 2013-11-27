@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('home'))

@section('content')
	<div class="title">
		<h3>Editar Lista de Bloqueio</h1>
	</div>

	<div class="contents">
		{{ Form::open(array('url' => URL::route('lists.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) }}
			<form role="form">

				<div class="form-group">
					<label for="name">Nome da lista</label>
					<input name="name" type="text" class="form-control" placeholder="nome" value="">
				</div>

				<div class="form-group">
				  	<label for="urls">URLs relacionadas</label>
					<textarea name="urls" id="urls" class="form-control" placeholder="lista de urls, uma por linha" rows="10"></textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-danger btn-lg">Criar lista</button>
					<a href="{{URL::route('lists.index')}}"><button class="btn btn-success btn-lg">Cancelar</button></a>
				</div>
			</form>
		{{ Form::close() }}
	</div>	
@stop