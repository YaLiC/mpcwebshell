<?php
/*** MPC Web Shell rpc.php ***/

include("config.php");
require("auth.php");

$mpc = "mpc -q -h " . $CONFIG["host"] . " ";
$comand	= isset($_GET['cmnd'])? filter_var($_GET['cmnd'], FILTER_SANITIZE_SPECIAL_CHARS) : false;
$ptpl	= isset($_GET['ptpl'])? filter_var($_GET['ptpl'], FILTER_SANITIZE_SPECIAL_CHARS) : false;
$findadd	= isset($_GET['fndd'])? filter_var($_GET['fndd'], FILTER_SANITIZE_SPECIAL_CHARS) : false;
$panopl	= isset($_GET['pnpl'])? filter_var($_GET['pnpl'], FILTER_SANITIZE_NUMBER_INT) : false;
$volume	= isset($_GET['vlm'])? filter_var($_GET['vlm'], FILTER_SANITIZE_NUMBER_INT) : false;
$seek	= isset($_GET['sk'])? filter_var($_GET['sk'], FILTER_SANITIZE_SPECIAL_CHARS) : false;

if ($comand == "status") {
	exec("mpc status",$stts);
	$tmp = str_replace(array(":", "%"), "", explode(" ", preg_replace('/\s+/',' ',$stts[count($stts)-1])));
	for ($i=0; $i<count($tmp); $i++) { $status[$tmp[$i]] = $tmp[$i+1]; $i++; }

	if (count($stts) == 3) {
		$tmp = str_replace(array("[", "]", "(", ")", "#", "%"), "", explode(" ", preg_replace('/\s+/',' ',$stts[1]) ));
		$status["switch"] = $tmp[0];
		$status["of"] = explode("/",$tmp[1]);
		$status["time"] = explode("/",$tmp[2]);
		$status["progress"] = $tmp[3];
	} else {
		$status["switch"] = "stop";
		$status["of"][0] = "0"; $status["of"][1] = "0";
		$status["time"][0] = "0:00"; $status["time"][1] = "0:00";
		$status["progress"] = "0";
	}

	exec($mpc . "current -f %file%#=%name%#=%position%#=%time%#=%album%#=%artist%#=%title%", $crr);
	$current = explode("=", $crr[0]);
	$status["current"] = $current;

	echo json_encode($status);
}

if ($comand == "playlist") {
	exec($mpc . "playlist",$playlist);
	for ($i=0;$i<count($playlist);$i++) {
		$n = $i + 1;
		echo '<div class="plstitem" data-item="' .$n. '"><span class="number">' . $n . '</span>. <span class="text">' . $playlist[$i] . '</span></div>';
	}
}

if ($comand == "lsplst") {
	exec($mpc . "lsplaylists",$playlists);
	echo '<option>...</option>';
	for ($i=0;$i<count($playlists);$i++) {
		echo '<option>' . $playlists[$i] . '</option>';
	}
}

if ($panopl) {exec($mpc . "play " . $panopl);}
if ($ptpl) {exec($mpc . "load " . $ptpl);}
if ($findadd) {exec($mpc . "findadd any " . addcslashes($findadd," ") );}
if ($volume) {exec($mpc . "volume " . $volume);}
if ($seek) {
	$seek   = str_replace("m", "-", $seek);
	$seek   = str_replace("p", "+", $seek);
	exec($mpc . "seek " . $seek . "%");
}

switch($comand){
	case 'play':
	case 'pause':
	case 'stop':
	case 'next':
	case 'prev':
	case 'crop':
	case 'clear':
	case 'shuffle':
	case 'repeat':
	case 'single':
	case 'random':
	case 'consume':
	case 'update': exec("mpc -q \"$comand\""); break;
	case 'add': break;
	default: break;
}

?>
