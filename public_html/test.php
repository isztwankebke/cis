<?php

/*$name = "UsersController";

$name = preg_match('/Controller/', $name);

$aa;

$name.= "aa";
echo $name;



$password = sha1('blabla1@');
var_dump($password);
echo "<br>";
var_dump($GLOBALS);


*/

$startDate = new DateTime();
$interval = new DateInterval('P1W');
$interval2 = new DateInterval('P1D');
$endDate = new DateTime();
$endDate->add($interval);

$period = new DatePeriod($startDate, $interval2, $endDate);
foreach ($period as $day) {
	echo $day->format('Y-m-d'), "<br>";
}
$offset = '7';
$periodInfo1 = $startDate->sub(new DateInterval('P'.$offset.'W'));
echo $periodInfo1->format('Y-m-d'), "<br>";

var_dump($startDate);



var_dump($interval);
var_dump($endDate);
var_dump($interval2);
var_dump($period);

/*
$now = new DateTime();
$begin = $now->format('Y-m-d');
//$begin = $begin['date'];
$interval1 = new DateInterval('P1D');
$end = $now->modify('+ 2 day');
$periodInfo1 = $now->sub(new DateInterval('P2W')); //$date - $this->periodInfo1;
var_dump($periodInfo1);
var_dump($begin);
var_dump($end);
$period = new DatePeriod($begin, $interval1, $end);
var_dump($period);*/