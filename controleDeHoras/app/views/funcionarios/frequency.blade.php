@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('funcionario.frequency',$funcionario))

@section('content')

	@if($funcionario->isLoggedIn())
		<span class="badge badge-success">Está na ALERJ</span>
		<?php $loggedIn = true; ?>
	@else 
		<span class="badge badge-important">Não está na ALERJ</span>
		<?php $loggedIn = false; ?>
	@endif
	<h1>{{$funcionario->nome}}</h1>


	<div class="btn-group">
		<a class="btn btn-primary" href="{{ URL::route('funcionarios.edit', $funcionario->id) }}">Editar ficha cadastral</a>
		@include('_partials.funcionarioToggleButton')
	</div>

	<br><br>

	<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="examplex">
		<thead>
			<tr>
				<th>Data</th>
				<th>Entrada</th>
				<th>Saída</th>
				<th>Tempo</th>
				<th width="60px">Opções</th>
			</tr>
		</thead>
		<tbody>
			@foreach($horas as $hora)
				@if(isset($lastHora) and Tools::getDay($hora->hora_saida) == Tools::getDay($lastHora->hora_entrada))
					<tr class="info">
						<td colspan="3">Intervalo</td>
						<td>{{Tools::diff($hora->hora_saida,$lastHora->hora_entrada)}}</td>
						<td></td>
					</tr>
				@endif

				<tr>
					<td>{{Tools::date($hora->hora_entrada)}}</td>
					<td>{{Tools::time($hora->hora_entrada)}}</td>
					<td>{{Tools::time($hora->hora_saida)}}</td>
					<td>{{Tools::diff($hora->hora_entrada,$hora->hora_saida)}}</td>
					<td>
						@if(!$hora->hora_saida or Auth::user()->id == 1)
							<a class="btn btn-danger btn-small" href="{{URL::route('horas.edit', $hora->id)}}">Editar</a>
						@endif
					</td>
				</tr>

				<?php $lastHora = $hora; ?>
			@endforeach
		</tbody>
	</table>
						
	<style type="text/css">
		table.table thead .sorting,
		table.table thead .sorting_asc,
		table.table thead .sorting_desc,
		table.table thead .sorting_asc_disabled,
		table.table thead .sorting_desc_disabled {
			cursor: pointer;
			*cursor: hand;
		}
		 
		table.table thead .sorting { background: url('assets/img/sort_both.png') no-repeat center right; }
		table.table thead .sorting_asc { background: url('assets/img/sort_asc.png') no-repeat center right; }
		table.table thead .sorting_desc { background: url('assets/img/sort_desc.png') no-repeat center right; }
		 
		table.table thead .sorting_asc_disabled { background: url('assets/img/sort_asc_disabled.png') no-repeat center right; }
		table.table thead .sorting_desc_disabled { background: url('assets/img/sort_desc_disabled.png') no-repeat center right; }
	</style>
@stop


@section('javascript-inline')
	jQuery(document).ready(function() {
		jQuery('#examplex').dataTable( {
			"sDom": "<'row'<'span6'><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			"aaSorting": [],
			"bSort" : false,
			"oLanguage": {
				"sSearch": "Filtrar:",
				"oPaginate": {
        			"sFirst": "Primeira",
        			"sLast": "Última",
        			"sNext": "Próxima",
        			"sPrevious": "Anterior"
      			},
      			"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
			}
		} );

		jQuery.extend( jQuery.fn.dataTableExt.oStdClasses, {
			"sWrapper": "dataTables_wrapper form-inline"
		});

		jQuery('button[toggleUserId]').click(function(evnt) {
			var href = jQuery(this).attr('href');
			var message = jQuery(this).attr('toggleConfirmationMessage');

			if (!jQuery('#dataConfirmModal').length) {
				jQuery('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Atenção</h3></div><div class="modal-body">'+message+'</div><div class="modal-footer"><button class="btn btn-success" data-dismiss="modal" aria-hidden="true">NÃO</button><a class="btn btn-danger" id="dataConfirmOK">SIM</a></div></div>');
			} 

			jQuery('#dataConfirmModal').find('.modal-body').text(message);
			jQuery('#dataConfirmOK').attr('href', href);
			jQuery('#dataConfirmModal').modal({show:true});
		})
	});

	jQuery('a[toggleUserId]').click(function(evnt) {
			var href = jQuery(this).attr('href');
			var message = jQuery(this).attr('toggleConfirmationMessage');

			if (!jQuery('#dataConfirmModal').length) {
				jQuery('body').append('<div id="dataConfirmModal" class="modal" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Atenção</h3></div><div class="modal-body">'+message+'</div><div class="modal-footer"><button class="btn btn-success" data-dismiss="modal" aria-hidden="true">NÃO</button><a class="btn btn-danger" id="dataConfirmOK">SIM</a></div></div>');
			} 

			jQuery('#dataConfirmModal').find('.modal-body').text(message);
			jQuery('#dataConfirmOK').attr('href', href);
			jQuery('#dataConfirmModal').modal({show:true});
	});

@stop	
