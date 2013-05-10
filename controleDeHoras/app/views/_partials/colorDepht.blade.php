@extends('layouts.main')

@section('content')

	sim

@stop

@section('javascript-inline')
	if (!matchMedia('all and (min-color: 6)').matches) {
		alert('rdp!');
	}
@stop

