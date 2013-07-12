@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('funcionario.login'))

@section('content')

	{{ Form::open( array('method' => 'POST', 'route' => 'login') ) }}

		<div class="row">
		    <div class="span5 offset4">
		      <div class="well">
		        <legend>Login</legend>
		        <form method="POST" action="" accept-charset="UTF-8">
		        	@if(isset($error))
			            <div class="alert alert-error">
			                <a class="close" data-dismiss="alert" href="#">x</a>Usuário ou senha inválida!
			            </div>
			        @endif
		            <input class="span4" placeholder="Usuário" type="text" name="username" value="{{ Input::get('username') }}">
		            <input class="span4" placeholder="Senha" type="password" name="password">
		            <br>
		            <button class="btn-info btn" type="submit">Login</button>      
		        </form>    
		      </div>
		    </div>
		</div>

	{{ Form::close() }}

@stop
