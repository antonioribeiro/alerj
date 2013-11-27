<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{URL::to('/')}}/assets/custom/img/favicon.png">
 
    <title>ALERJ - Proxy Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::to('/')}}/assets/packages/bootstrap3/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{{URL::to('/')}}/assets/packages/prettyCheckable/prettyCheckable.css" rel="stylesheet" media="screen">
 
    <!-- Custom styles for this template -->
    <link href="{{URL::to('/')}}/assets/custom/css/site.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/assets/custom/css/tree.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="../..{{URL::to('/')}}/assets/js/html5shiv.js"></script>
        <script src="../..{{URL::to('/')}}/assets/js/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::route('home')}}">Proxy Admin</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Opções <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('loginForm') }}">Login</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('logout') }}">{{ $layoutLogout }}</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::route('lists.index') }}">Gerenciar Listas</a></li>
                    </ul>
                </li>
                </ul>
            </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="breadcrumbs">
            @yield('breadcrumbs')
        </div>

        <div class="container">

            @if( Session::get('message') )
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            @if( Session::get('error') )
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @yield('content')

        </div><!-- /.container -->

        <script src="{{URL::to('/')}}/assets/packages/jquery/jquery-2.0.3.min.js"></script>
        <script src="{{URL::to('/')}}/assets/packages/bootstrap3/dist/js/bootstrap.min.js"></script>
        <script src="{{URL::to('/')}}/assets/packages/prettyCheckable/prettyCheckable.js"></script>

        <script>
            $().ready(function(){

                $('input.prettyCheckable').prettyCheckable({
                    color: 'red'
                });

            });
        </script>

    </body>
</html>
