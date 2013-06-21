<?php

use Carbon\Carbon;

Class Tools {

	static public function date($date) {
		if($date)
		{
			$date = new ExpressiveDate($date);
			$date->setDefaultDateFormat('d.m.Y');
			return "$date - ".static::dayOfWeek($date);
		}
	}

	static public function time($date) {
		if($date)
		{
			$d = new ExpressiveDate($date);
			$d->setDefaultDateFormat('H:i');
			return "$d";
		}
	}

	static public function format($date, $format) {
		if($date)
		{
			$d = new ExpressiveDate($date);
			$d->setDefaultDateFormat($format);
			return Tools::translate("$d");
		}
	}

	static public function dateAndTime($date) {
		return Tools::date($date).' - '.Tools::time($date);
	}

	static public function dayOfWeek($date) {
		if($date)
		{
			$date = new ExpressiveDate($date);
			$date->setDefaultDateFormat('H:i');
			$dow = $date->getDayOfWeek();

			switch($dow)
			{
				case "Monday":    $day = "Segunda";  break;
				case "Tuesday":   $day = "Terça"; break;
				case "Wednesday": $day = "Quarta";  break;
				case "Thursday":  $day = "Quinta"; break;
				case "Friday":    $day = "Sexta";  break;
				case "Saturday":  $day = "Sábado";  break;
				case "Sunday":    $day = "Domingo";  break;
				default:          $day = "erro"; break;
			}			

			return $day;
		}

	}

	static public function diff($date1,$date2) {
		return Tools::seconds2human(Tools::diffInSeconds($date1,$date2));
	}

	static public function diffInSeconds($date1,$date2) {
		if($date1)
		{
			$date1 = new ExpressiveDate($date1);
			if($date2) {
				$date2 = new ExpressiveDate($date2);
			} else {
				$date2 = new ExpressiveDate;
			}
			// $date = 
			//$date->setDefaultDateFormat('H:m:s');
			return $date1->getDifferenceInSeconds($date2);
		}
	}

	static public function seconds2human($ss) {
		$s = $ss%60;
		$m = floor(($ss%3600)/60);
		$h = floor(($ss%86400)/3600);
		$d = floor(($ss%2592000)/86400);
		$M = floor($ss/2592000);

		$r = ($M ? "$M mes".($M>1?"es":"").", " : "")
			.($d ? "$d dia".($d>1?"s":"").", " : "")
			.($h ? $h."h, " : "")
			.($m ? $m."m" : "");

		return $r;			
	}

	static public function seconds2humanHours($ss) {
		$s = $ss%60;
		$m = floor(($ss%3600)/60);
		$h = floor(($ss%86400)/3600);
		$d = floor(($ss%2592000)/86400);
		$M = floor($ss/2592000);

		$h += $d*24;
		$d = 0;

		$r = ($M ? "$M mes".($M>1?"es":"").", " : "")
			.($d ? "$d dia".($d>1?"s":"").", " : "")
			.($h ? $h."h, " : "")
			.($m ? $m."m" : "");

		return $r;			
	}

	static public function firstDayOfWeek($wk_num, $yr, $first = 1, $format = 'F d, Y') 
	{ 
		$wk_ts  = strtotime('+' . $wk_num . ' weeks', strtotime($yr . '0101')); 
		$mon_ts = strtotime('-' . date('w', $wk_ts) + $first . ' days', $wk_ts);

		return $mon_ts; 
	} 

	static public function firstDayOfWeekfromDate($wk_ts)
	{ 
		$mon_ts = strtotime('-' . date('w', $wk_ts) + 1 . ' days', $wk_ts);

		return $mon_ts; 
	} 

	static public function getDay($date) 
	{ 
		if($date)
		{
			$date = new Carbon($date);
			return $date->day;
		}
	} 

	static function translate($s) 
	{

		$s = str_replace('January', 'Janeiro', $s);
		$s = str_replace('February', 'Fevereiro', $s);
		$s = str_replace('March', 'Março', $s);
		$s = str_replace('April', 'Abril', $s);
		$s = str_replace('May', 'Maio', $s);
		$s = str_replace('June', 'Junho', $s);
		$s = str_replace('July', 'Julho', $s);
		$s = str_replace('August', 'Augosto', $s);
		$s = str_replace('September', 'Setembro', $s);
		$s = str_replace('October', 'Outubro', $s);
		$s = str_replace('November', 'Novembro', $s);
		$s = str_replace('December', 'Dezembro', $s);

		return $s;
	}

	static function inIpRange($ip_one, $ip_two=false){ 
		if($ip_two===false){ 
			if($ip_one==$_SERVER['REMOTE_ADDR']){ 
				$ip=true; 
			}else{ 
				$ip=false; 
			} 
		}else{ 
			if(ip2long($ip_one)<=ip2long($_SERVER['REMOTE_ADDR']) && ip2long($ip_two)>=ip2long($_SERVER['REMOTE_ADDR'])){ 
				$ip=true; 
			}else{ 
				$ip=false; 
			} 
		} 
		return $ip; 
	} 	
}