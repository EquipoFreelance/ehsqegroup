<?php

namespace App\Helpers;

use DateTime;
use DateInterval;
use DatePeriod;

class Helper
{
    public static function strNomCorto($value){
      return strtoupper($value);
    }

    public static function rangeInterval($f_inicio, $f_fin, $week_days = array()){

      $date_range = array();
      $begin = new DateTime( $f_inicio );
      $end   = new DateTime( $f_fin );

      $interval  = DateInterval::createFromDateString('1 day');

      $end->setTime(0, 0)->add($interval);

      $daterange = new DatePeriod($begin, $interval, $end);

      foreach($daterange as $date){

          $day_value = date("N", strtotime($date->format("Y-m-d")));      // Valor del Día de la semana

          if(in_array($day_value, $week_days)){
              $day_text  = date("l", strtotime($date->format("Y-m-d")));  // Text del Día de la semana
              $day_date  = $date->format("Y-m-d");                        // Fecha encontrada
              $date_range[] = array("cod_dia" => $day_value, "fecha" => $day_date, "day_text" => $day_text);
          }

      }

      return json_encode($date_range);

    }

    public static function replaceFormat($format, $f){

        if($format == "/"){
          $fecha = explode("/", $f);
        }
        return $fecha[2]."-".$fecha[1]."-".$fecha[0];

    }


}
