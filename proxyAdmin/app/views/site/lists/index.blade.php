@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('home'))

@section('content')

	<div class="title">
		<h3>Listas de Bloqueio</h1>
	</div>


	<div class="contents">
		<table class="table table-bordered table-striped">
			@foreach($lists as $list)
			<tr>
				<td>
					{{link_to_route('lists.edit', $list->name, [$list->id])}}
				</td>
			</tr>
			@endforeach
		</table>

		<a href="{{URL::route('lists.create')}}"><button type="submit" class="btn btn-success btn-lg">Nova Lista</button></a>
	</div>	
@stop