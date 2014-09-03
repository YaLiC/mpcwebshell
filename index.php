<?php
exec('mpc playlist | cat -n > /tmp/mpc.plst');
?><!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="author" content="YaLiC">
	<meta name="description" content="Веб-интерфейс для MPD. Веб-оболочка для MPC">
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>MPC Web Shell</title>
	<link rel="shortcut icon" href="/mpd-icon.png" />
	<link rel="stylesheet" href="style.css" />
</head>

<body onload="control('state');">

<script>
function control(command) {
	var state = document.getElementById('state');
	var npp = document.getElementById('npp').value;
	var xhr = new XMLHttpRequest();

	if (command == "playn") {
		xhr.open('GET', 'rpc.php?action=playn&npp=' + npp, true);
	} else {
		xhr.open('GET', 'rpc.php?action=' + command, true);
	}
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) return;
		state.innerHTML = xhr.responseText;
	}
	state.innerHTML = '...';
	xhr.send(null);
}
setInterval('control("state")', 15000);
</script>

<header>
	<h1>Панель управления музыкальным плеером</h1>
</header>

<nav>
<button class="large color blue button htooltip" onclick="control('play')">&#9658;<span>Воспроизведение</span></button>
<button class="large color green button htooltip" onclick="control('pause')">|&nbsp;|<span>Приостановить</span></button>
<button class="large color red button htooltip" onclick="control('stop')">[&nbsp;]<span>Остановить</span></button>
<br/><br/>
<button class="button htooltip" onclick="control('prev')">&larr;&nbsp;&bull;<span>Предыдущий пункт списка воспроизведения</span></button>
<button class="button htooltip" onclick="control('seek-')">&laquo;&laquo;&laquo;<span>Прокрутить назад</span></button>
<button class="button htooltip" onclick="control('seek+')">&raquo;&raquo;&raquo;<span>Прокрутить вперёд</span></button>
<button class="button htooltip" onclick="control('next')">&bull;&nbsp;&rarr;<span>Следующий пункт списка вопроизведения</span></button>
<br/><br/>
<button class="small button htooltip" onclick="control('random')">&sup2;.&sup1;.&sup3;<span>В случайном порядке</span></button>
<button class="small button htooltip" onclick="control('repeat')">&equiv;&infin;<span>Повторять список</span></button>
<button class="small button htooltip" onclick="control('single')">&minus;&infin;<span>Повторять пункт списка</span></button>
<button class="small button htooltip" onclick="control('shuffle')">&darr;&equiv;&uarr;<span>Перемешать пункты списка</span></button>
<button class="small button htooltip" onclick="control('consume')">&times;&rarr;<span>Убирать пункты после окончания</span></button>
<br/><br/>
<ul class="button-group">
	<li><button class="small button htooltip" onclick="control('volumeminus')"><span>Громкость -5</span>&minus;</button></li>
	<li><button class="small button" onclick="control('volume30')">30%</button></li>
	<li><button class="small button" onclick="control('volume50')">50%</button></li>
	<li><button class="small button" onclick="control('volume70')">70%</button></li>
	<li><button class="small button" onclick="control('volume80')">80%</button></li>
	<li><button class="small button" onclick="control('volume90')">90%</button></li>
	<li><button class="small button" onclick="control('volume100')">100%</button></li>
	<li><button class="small button htooltip" onclick="control('volumeplus')"><span>Громкость +5</span>&plus;</button></li>
</ul>
</nav>

<hr />

<div role="main">
<output id="state" onclick="control('current')">...</output>

<details>
	<summary>&equiv;</summary>
	<pre>
<?php echo file_get_contents('/tmp/mpc.plst'); ?>
	</pre>
	<div style="margin-top:10px; text-align:left;">
		<span>№:</span>
		<input id="npp" type="text" pattern="[0-9]{,3}" placeholder="123" style="width:30px;" />
		<button class="small button color blue" onclick="control('playn')">&#9658;</button>
	</div>
</details>
</div>

<footer>Copyleft: GNU GPL v2. &bull; Developed by: <a href="https://github.com/YaLiC">YaLiC</a>. &bull; View and download the code, click here: <a href="https://github.com/YaLiC/mpcwebshell">GitHub</a>. &bull; <?php echo exec('mpc version'); ?></footer>

</body>
</html>
