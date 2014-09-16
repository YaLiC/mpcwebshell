<?php
include("config.php");
require("auth.php");
?><!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="author" content="YaLiC">
	<meta name="description" content="Веб-интерфейс для MPD. Веб-оболочка для MPC">
	<title>MPC Web Shell</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="glyphicons/glyphicons.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="jquery-2.1.1.min.js"></script>
	<script src="script.js"></script>
</head>

<body>

<div id="player" role="main">

<div id="display">
	<div id="wait"><span class="glyphicon glyphicon-signal"></span></div>
	<div id="file">&mdash;</div>
	<div id="album">&mdash;</div>
	<div id="artist">&mdash;</div>
	<div id="track">&mdash;</div>
	<div id="progbox">
		<span id="switch">&mdash;</span>
		<span id="timestart">00:00</span>
		<progress id="progress" min="0" max="100" value="0"></progress>
		<span id="timeend">00:00</span>
		<span id="of">&mdash;</span>
	</div>
</div>


<div id="control">
	<div class="btn-one">
		<button id="prev"><span class="glyphicon glyphicon-step-backward"></span></button>
		<button id="seekm"><span class="glyphicon glyphicon-backward"></span></button>
		<button id="play"><span class="glyphicon glyphicon-play"></span></button>
		<button id="pause"><span class="glyphicon glyphicon-pause"></span></button>
		<button id="stop"><span class="glyphicon glyphicon-stop"></span></button>
		<button id="seekp"><span class="glyphicon glyphicon-forward"></span></button>
		<button id="next"><span class="glyphicon glyphicon-step-forward"></span></button>
	</div>
	<div class="btn-two">
		<span id="ledsh" class="led"><button id="shuffle"><span class="glyphicon glyphicon-sort"></span></button></span>
		<span id="ledra" class="led"><button id="repall"><span class="glyphicon glyphicon-repeat"></span></button></span>
		<span id="ledrs" class="led"><button id="repsin"><span class="glyphicon glyphicon-refresh"></span></button></span>
		<span id="ledrd" class="led"><button id="random"><span class="glyphicon glyphicon-random"></span></button></span>
		<span id="ledcs" class="led"><button id="consume"><span class="glyphicon glyphicon-fire"></span></button></span>
	</div>
	<div id="volbox">
		<span class="glyphicon glyphicon-volume-down"></span>
		<input id="volume" type="range" min="0" max="100" value="0">
		<span class="glyphicon glyphicon-volume-up"></span>
	</div>
</div><!-- /control -->


<div id="playlist">...</div>


<div id="plstmisc">

	<select id="listplaylist" style="width:120px; height:25px; margin:0;"></select>
	<button id="clear"><span class="glyphicon glyphicon-remove"></span></button>

	<div id="searchbox">
		<input id="search" type="search" placeholder="Album, Artist, Title">
		<button id="find"><span class="glyphicon glyphicon-search"></span></button>
	</div>

</div><!-- /plstmisc -->


</div><!-- /player -->


<footer>Copyleft: GNU GPL v2. &bull; Developed by: <a href="https://github.com/YaLiC">YaLiC</a>. &bull; View and download the code, click here: <a href="https://github.com/YaLiC/mpcwebshell">GitHub</a>. &bull; <?php echo exec('mpc version'); ?></footer>

</body>
</html>