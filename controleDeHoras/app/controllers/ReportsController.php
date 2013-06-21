<?php

use Carbon\Carbon;

class ReportsController extends BaseController {

	public function weekly()
	{
		$horas = Hora::whereNotNull('id')->orderBy('id')->first();

		$funcionarios = Funcionario::all();

		$date = new Carbon($horas->hora_entrada);

		$firstWeek = $date->weekOfYear;

		$date = Carbon::createFromTimestamp( Tools::firstDayOfWeek($firstWeek, $date->year) );

		$weeks = [];
		while($date->weekOfYear >= $firstWeek) {
			$date->hour = 0;
			$date->minute = 0;
			$date->second = 0;
			$from = $date->toDateTimeString();

			$date->addDays(4);
			$date->hour = 23;
			$date->minute = 59;
			$date->second = 59;
			$to = $date->toDateTimeString();

			$weeks[] = [
				'week'=>$date->weekOfYear,
				'year'=>$date->year,
				'from'=>$from,
				'to'=>$to,
				'fromMY'=>Tools::format($from,'d/F'),
				'toMY'=>Tools::format($to,'d/F'),
			];

			$date->subDays(4);
			$date->addWeek();
		}

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
			
			if($horas->count() == 0) {
				$r = '"'.$funcionario->nome.'";'.'"nenhum lançamento encontrado"';
			}

			foreach($horas->orderBy('id')->get() as $hora) {
				$t = (new Carbon( $hora->hora_entrada ))->diff((new Carbon( $hora->hora_saida )));
				$t = Carbon::create($t->y,$t->m,$t->d,$t->h,$t->i,$t->s);

				if($first or $date !== (new Carbon( $hora->hora_entrada ))->format('d/m/Y')) {
					$date = (new Carbon( $hora->hora_entrada ))->format('d/m/Y');

					$r .= ($r ? "\n" : "")
						 . '"'.$funcionario->nome.'"'
						 .';"'.$date.'"'
						 .';'.'""';

					$first = false;

					$cols = 0;
				}

				$r .= ';"'.(new Carbon( $hora->hora_entrada ))->format('H:i').'"'
					  .';"'.(new Carbon( $hora->hora_saida ))->format('H:i').'"'
 					  .';"'.$t->format('H:i').'"'
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
				 .';'.'"Tempo"';

		}

		$l = utf8_decode ( $h."\n".$l );
		
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="horas.csv"');
		echo $l;
	}

}