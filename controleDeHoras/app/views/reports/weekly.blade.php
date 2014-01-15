@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('reports.weekly'))

@section('content')

	<h1>Relatório por semana</h1>

	@foreach(range(2013, \Carbon\Carbon::now()->year) as $year)
		<a href="{{ URL::route('reports.weekly', $year) }}" class="btn btn-primary">{{$year}}</a>
	@endforeach

	<br><br>

	<table style="max-width: none;" cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
		<thead>
			<tr>
				<th>Semana</th>
				@foreach($funcionarios as $funcionario)
					<th>{{str_replace(' ', '<br>', $funcionario->nome)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($weeks as $week)
				<tr>
					<td><p class="text-center">{{$week['week']}}/{{$week['year']}}</p><p class="text-center">{{$week['fromMY']}}<br>{{$week['toMY']}}<br><br><a class="btn btn-mini" href="{{ URL::route('reports.xls', [$week['week'],$week['year']]) }}">XLS</a></p></td>
					@foreach($funcionarios as $funcionario)
						<td>{{Funcionario::workHours($funcionario->id,$week['from'],$week['to'])}}</td>
					@endforeach
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
@stop	
