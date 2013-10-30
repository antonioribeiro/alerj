@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('proxy'))

@section('content')

	<div class="title">
		<h1>{{$message}}</h1>
	</div>
@stop