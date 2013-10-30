@extends('layout')

@section('breadcrumbs', Breadcrumbs::render('login'))

@section('content')

    <div class="title">
        <h1>Login</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ URL::to('login') }}" method="POST" accept-charset="UTF-8" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Login" name="username" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="password" type="password" value="">
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop