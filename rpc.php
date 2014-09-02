<?php

$action	= isset($_GET['action'])? filter_var($_GET['action'], FILTER_SANITIZE_ENCODED) : false;
$npp = isset($_GET['npp'])? filter_var($_GET['npp'], FILTER_SANITIZE_ENCODED) : false;

if ($action == "playn" && $npp) {exec('mpc play '.$npp);}
if ($action == "play") {exec('mpc play');}
if ($action == "pause") {exec('mpc pause');}
if ($action == "stop") {exec('mpc stop');}
if ($action == "next") {exec('mpc next');}
if ($action == "prev") {exec('mpc prev');}
if ($action == "repeat") {exec('mpc repeat');}
if ($action == "single") {exec('mpc single');}
if ($action == "consume") {exec('mpc consume');}
if ($action == "random") {exec('mpc random');}
if ($action == "shuffle") {exec('mpc shuffle');}

switch ($action) {
case "seek-":
        exec('mpc seek -');
        break;
case "seek+":
        exec('mpc seek +');
        break;
}

switch ($action) {
case "volume100":
	exec('mpc volume 100');
	break;
case "volume90":
        exec('mpc volume 90');
        break;
case "volume80":
        exec('mpc volume 80');
        break;
case "volume70":
        exec('mpc volume 70');
        break;
case "volume50":
        exec('mpc volume 50');
        break;
case "volume30":
        exec('mpc volume 30');
        break;
case "volumeminus":
	exec('mpc volume -5');
	break;
case "volumeplus":
	exec('mpc volume +5');
	break;
}

echo exec('mpc')."<br/></br>";
echo exec('mpc current -f "[## %position% ##<br/>] & [[%name%] | [%album%]] & [#<br/>%artist% #&mdash; %title%]"');

?>

