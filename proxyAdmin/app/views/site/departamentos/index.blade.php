@extends('layout')

@if($departamento)
	@section('breadcrumbs', Breadcrumbs::render('departamento', $departamento))
@else
	@section('breadcrumbs', Breadcrumbs::render('departamentos'))
@endif

@section('content')

	<div class="title">
		<h1>Selecione o departamento</h1>
	</div>

	<div class="contents">
		<div class="tree">
			<ul>
				<?php 
					$count = count($departamentos); 
					if ($count == 1) {
						echo '<li>', $departamentos[0]->nome_departamento, '</li>'; 
					} else { 
						$i = 0;
						while (isset($departamentos[$i])) {
							 
							echo '<li><a href="'.URL::route('departamento',[$parent,$departamentos[$i]->codigo_departamento]).'">'.$departamentos[$i]->sigla_departamento.' - '.utf8_encode($departamentos[$i]->nome_departamento).'</a>'; 
							
							Log::info($departamentos[$i]->nome_departamento);

							if ($i < $count - 1) { 
								 
								if ($departamentos[$i + 1]->nivel > $departamentos[$i]->nivel) { 
									echo '<ul>'; 
								} else { 
									echo '</li>'; 
								} 
								 
								if ($departamentos[$i + 1]->nivel < $departamentos[$i]->nivel) { 
									echo str_repeat('</ul></li>' . "\n", ($departamentos[$i]->nivel-1) - ($departamentos[$i + 1]->nivel-1)); 
								} 
								 
							} else { 
								echo '<li>'; 
								echo str_repeat('</ul></li>' . "\n", $departamentos[$i]->nivel-1); 
							} 
							$i++; 
						} // END while 
					} // END else 
				?>
			</ul>
		</div>
	</div>

@stop


