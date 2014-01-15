<?php

use Carbon\Carbon;

class ReportsController extends BaseController {

	public function weekly($year)
	{
		$funcionarios = Funcionario::all();

		$date = Carbon::create($year, 1, 1, 0, 0, 0)->startOfWeek();
		$lastWeek = Carbon::create($year, 12, 31, 0, 0, 0)->next(Carbon::FRIDAY)->weekOfYear;

		if (Carbon::now()->year == $year)
		{
			$currentWeek = Carbon::now()->weekOfYear;
		}
		else
		{
			$currentWeek = 52 + ($lastWeek == 1 ? 1 : 0);
		}

		$weeks = [];

		foreach(range($date->weekOfYear, $currentWeek) as $week) {
			$weeks[] = [
				'week'=>$date->weekOfYear,
				'year'=>$date->year,
				'from'=>$date->startOfWeek(),
				'to'=>$date->next(Carbon::FRIDAY),
				'fromMY'=>Tools::format($date->startOfWeek(),'d/F'),
				'toMY'=>Tools::format($date->next(Carbon::FRIDAY),'d/F'),
			];

			$date->addWeek();
		}

		$weeks = array_reverse($weeks);

		return View::make('reports.weekly')
				->with('weeks', $weeks)
				->with('funcionarios',$funcionarios);
	}

	public function xls($week, $year)
	{
		$date = new Carbon( 'first day of january '.$year );
		$date = Carbon::createFromTimestamp( Tools::firstDayOfWeekFromDate($date->timestamp) );
		$date->addWeeks($week-1);
		$from = $date->toDateTimeString();

		$date->addDays(4);
		$date->hour = 23;
		$date->minute = 59;
		$date->second = 59;
		$to = $date->toDateTimeString();

		$funcionarios = Funcionario::all();

		$maxCols = 0;

		$l = '';

		foreach($funcionarios as $funcionario)
		{

			$horas = Hora::where('funcionario_id', $funcionario->id)->where('hora_entrada','>=',$from)->where('hora_entrada','<=',$to);

			$first = true;
			$date = "";
			$r = "";
			
			if ($horas->count() == 0) {
				$r = '"'.$funcionario->nome.'";'.'"nenhum lançamento encontrado"';
			}

			foreach($horas->orderBy('id')->get() as $hora) {
				$e = new Carbon( $hora->hora_entrada );
				$e->second = 0;
				$s = new Carbon( $hora->hora_saida );
				$s->second = 0;
				$t = $e->diff($s);
				$t = $t->h+($t->i/60); // Carbon::create($t->y,$t->m,$t->d,$t->h,$t->i,$t->s);

				if ($first or $date !== (new Carbon( $hora->hora_entrada ))->format('d/m/Y')) {
					$date = (new Carbon( $hora->hora_entrada ))->format('d/m/Y');

					$r .= ($r ? "\n" : "")
						 . '"'.$funcionario->nome.'"'
						 .';"'.$date.'"'
						 .';'.'""';

					$first = false;

					$cols = 0;
				}

				$modification = '';
				if ( !empty($hora->alterado_em))
				{
					$modification = Funcionario::find($hora->alterado_por)->nome.' - '.$hora->descricao;
				}

				$r .= ';"'.(new Carbon( $hora->hora_entrada ))->format('H:i').'"'
					  .';"'.(new Carbon( $hora->hora_saida ))->format('H:i').'"'
 					  .';'.str_replace('.', ',', $t).''
 					  .';"'.($hora->saida_automatica ? 'Sim' : '').'"'
 					  .';"'.$modification.'"'
					  .';'.'""'
					  ;
				$cols++;

				$maxCols = $cols > $maxCols ? $cols : $maxCols;
			}

			$l .= $r."\n";
		}

		$h = '"Funcionario"'
			 .';'.'"Data"';

		for($x = 1; $x <= $maxCols; $x++) {
		
			$h .= ';'.'""'
				 .';'.'"Entrada"'
				 .';'.'"Saida"'
				 .';'.'"Tempo"'
				 .';'.'"Saída Automatica"'
				 .';'.'"Modificado"'
				 ;

		}

		$l = utf8_decode ( $h."\n".$l );
		
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="horas.csv"');
		echo $l;
	}

}