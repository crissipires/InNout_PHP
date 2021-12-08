<?php

function getDateAsDateTime($date){
    return is_string($date) ? new DateTime($date) : $date;
}

function isWeekend($date){
    $inputDate = getDateAsDateTime($date);
    return $inputDate->format('N') >= 6;
}

function isBefore($date1, $date2){
    $inputDate1 = getDateAsDateTime($date1);
    $inputDate2 = getDateAsDateTime($date2);
    return $inputDate1 <= $inputDate2;
}

function getNextDay($date){
    return getDateAsDateTime($date)->modify('+ 1 day');
}

function sumIntervals($intervalo1, $intervalo2){
    $date = new DateTime('00:00:00');
    $date->add($intervalo1);
    $date->add($intervalo2);
    return (new DateTime('00:00:00'))->diff($date);
}


function subtractIntervals($intervalo1, $intervalo2){
    $date = new DateTime('00:00:00');
    $date->add($intervalo1);
    $date->sub($intervalo2);
    return (new DateTime('00:00:00'))->diff($date);
}

function getDateFromInterval($interval){
    return new DateTimeImmutable($interval->format('%H:%i:%s'));
}
  
function getDateFromString($str){
    return DateTimeImmutable::createFromFormat('H:i:s', $str);
}

function getLastDayOfMonth($date) {
    $time = getDateAsDateTime($date)->getTimesTamp();
    return new DateTime(date('Y-m-t', $time));

}