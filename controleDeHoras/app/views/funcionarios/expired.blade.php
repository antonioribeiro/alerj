@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('funcionario.expired'))

@section('content')

	A sua sessão expirou. Por favor faça {{ link_to_route('login', 'login') }} novamente.

@stop


