@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('home'))

@section('content')

	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="examplex">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Ramais</th>
				<th>Matrícula</th>
				<th>Divisão</th>
				<th>Está na ALERJ?</th>
			</tr>
		</thead>
		<tbody>
			@foreach(Funcionario::all() as $funcionario)
				<tr>
					<td>{{$funcionario->id}}</td>
					<td>{{Html::link(URL::route('funcionarios.frequency',$funcionario->id), $funcionario->nome)}}</td>
					<td>{{$funcionario->ramais()}}</td>
					<td>{{$funcionario->matricula}}</td>
					<td>{{$funcionario->divisao}}</td>
					<td>
						<p class="text-center">
							@include('_partials.funcionarioToggleButton')
						</p>
					</td>
				</tr>
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
			"iDisplayLength": 50,
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

		jQuery('a[toggleUserId]').click(function(evnt) {
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
@stop	
