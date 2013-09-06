<!DOCTYPE html>
<html lang="en">
<head>
	<noscript><meta http-equiv="refresh" content="0; url={{URL::route('nojavascript')}}"></noscript>

	<meta charset="utf-8">
	<title>DITI/ALERJ - Controle de Horas</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="{{URL::to('/')}}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{URL::to('/')}}/assets/css/retriever.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-top: 60px;
		padding-bottom: 40px;
	  }
	</style>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="../assets/ico/favicon.png">
	<script>window["_GOOG_TRANS_EXT_VER"] = "1";</script>
</head>

<body>
	<div id="page">

		<script type="text/javascript">
			console.log('screen.colorDepth = ' + screen.colorDepth);

			if ( screen.colorDepth < 24 ) {
				route = "{{URL::route('rdp')}}"; if (window.location != route) { window.location = route; }
			}
		</script>

		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="{{URL::to('/')}}">SDGI - Controle de Horas</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Opções <b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="{{URL::route('logout')}}">Logout</a>
									</li>
									<li>
										<a href="{{URL::route('home')}}">Funcionários</a>
									</li>
									<li>
										<a href="{{URL::route('reports.weekly')}}">Relatório semanal</a>
									</li>
								</ul>
							</li>
						</ul>

						@if ( ! Auth::guest() )
							<ul class="nav">
								<li class="dropdown">
									<a href="{{URL::route('funcionarios.frequency',Auth::user()->id)}}">
										{{Funcionario::getLoggedUserFullName()}}
									</a>
								</li>
							</ul>
						@endif
						
					</div>
					<!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			@yield('breadcrumbs')
			
			@if (Session::has('message'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{Session::get('message')}}
				</div>		
			@endif

			@if (Session::has('error'))
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{Session::get('error')}}
				</div>		
			@endif

			<!-- Main hero unit for a primary marketing message or call to action -->
			<br>
			@yield('content')

			<!-- Example row of columns -->

			<hr>

			<footer>
				<p>© DITI/SDGI/ALERJ 2013</p>
			</footer>

		</div>
		<!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="{{URL::to('/')}}/assets/js/bootstrap.min.js"></script>
		<script src="{{URL::to('/')}}/assets/js/jquery.dataTables.min.js"></script>
		<script src="{{URL::to('/')}}/assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="{{URL::to('/')}}/assets/js/matchMedia.js"></script>

		<a class="hiddenlink" href="#" accesskey="t"></a>
		<div style="display: none;" id="hiddenlpsubmitdiv"></div>
		<script>try{for(var lastpass_iter=0; lastpass_iter < document.forms.length; lastpass_iter++){ var lastpass_f = document.forms[lastpass_iter]; if (typeof(lastpass_f.lpsubmitorig2)=="undefined"){ lastpass_f.lpsubmitorig2 = lastpass_f.submit; lastpass_f.submit = function(){ var form=this; var customEvent = document.createEvent("Event"); customEvent.initEvent("lpCustomEvent", true, true); var d = document.getElementById("hiddenlpsubmitdiv"); for(var i = 0; i < document.forms.length; i++){ if (document.forms[i]==form){ d.innerText=i; } } d.dispatchEvent(customEvent); form.lpsubmitorig2(); } } }}catch(e){}</script>
		<script>try{function lpshowmenudiv(id){   closelpmenus(id);   var div = document.getElementById('lppopup'+id);   var btn = document.getElementById('lp'+id);   if (btn && div){     var btnstyle = window.getComputedStyle(btn, null);     var divstyle = window.getComputedStyle(div, null);     var posx = btn.offsetLeft;     posx -= 80;     var divwidth = parseInt(divstyle.getPropertyValue('width'));     if (posx + divwidth > window.innerWidth - 25){       posx -= ((posx + divwidth) - window.innerWidth + 25);     }     div.style.left = posx + "px";     div.style.top = (btn.offsetTop + parseInt(btnstyle.getPropertyValue('height'))) + "px";         if (div.style.display=='block'){div.style.display = 'none'; if (typeof(slideup)=='function'){slideup();} }    else div.style.display = 'block';       } }function closelpmenus(id){   if (typeof(lpgblmenus)!='undefined'){     for(var i=0; i < lpgblmenus.length; i++){       if ((id==null || lpgblmenus[i]!='lppopup'+id) && document.getElementById(lpgblmenus[i]))         document.getElementById(lpgblmenus[i]).style.display = 'none';     }   }} var lpcustomEvent = document.createEvent('Event'); lpcustomEvent.initEvent('lpCustomEventMenu', true, true); }catch(e){}</script>
		<script>try{if (typeof(lpgblmenus)=='undefined'){ lpgblmenus = new Array(); }   lpgblmenus[lpgblmenus.length] = 'lppopupautofill';   }catch(e){}</script>
		<script>try{if (typeof(lpgblmenus)=='undefined'){ lpgblmenus = new Array(); }   lpgblmenus[lpgblmenus.length] = 'lppopupnever';   }catch(e){}</script>
		<script>try{document.addEventListener('mouseup', function(e){ if (typeof(closelpmenus)=='function'){closelpmenus();}}, false)}catch(e){}</script>

		<script type="text/javascript">
			@yield('javascript-inline')
		</script>
	</div>


</body>

</html>