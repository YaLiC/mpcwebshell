/*** MPC Web Shell script.js ***/

// SETUP

function UpdatePlaylist() {
	$('#playlist').load('rpc.php?cmnd=playlist');
	$('#listplaylist').load('rpc.php?cmnd=lsplst');
}

function UpdateDisplay() {
$.getJSON("rpc.php?cmnd=status", function(data) {
	$('#volume').val(data.volume);
	$('#progress').val(data.progress);
	$('#switch').text(data.switch);
	$('#of').text(data.of[0]+"/"+data.of[1]);
	$('#timestart').text(data.time[0]);
	$('#timeend').text(data.time[1]);
	if (data.repeat == "on") { $('#ledra').removeClass("off"); $('#ledra').addClass("on"); } else { $('#ledra').removeClass("on"); $('#ledra').addClass("off"); };
	if (data.random == "on") { $('#ledrd').removeClass("off"); $('#ledrd').addClass("on"); } else { $('#ledrd').removeClass("on"); $('#ledrd').addClass("off"); };
	if (data.single == "on") { $('#ledrs').removeClass("off"); $('#ledrs').addClass("on"); } else { $('#ledrs').removeClass("on"); $('#ledrs').addClass("off"); };
	if (data.consume == "on") { $('#ledcs').removeClass("off"); $('#ledcs').addClass("on"); } else { $('#ledcs').removeClass("on"); $('#ledcs').addClass("off"); };
	if (data.switch != "stop") {
		$('#file').html(data.current[0]);
		$('#album').html(data.current[1]+" "+data.current[4]);
		$('#artist').html(data.current[5]);
		$('#track').html(data.current[6]);
		$('.plstitem').eq(data.current[2]-1).children().css("font-weight","bold");
	}
});

}


// READY
$(document).ready(function() {

$(document).ajaxError(function(){alert('Не удалось выполнить запрос');});
$(document).ajaxStart(function(){$('#wait').show()});
$(document).ajaxStop(function(){$('#wait').delay(300).fadeOut('middle');});

$('#play').click(function(){ $.get("rpc.php?cmnd=play"); UpdateDisplay(); });
$('#pause').click(function(){ $.get("rpc.php?cmnd=pause"); UpdateDisplay(); });
$('#stop').click(function(){ $.get("rpc.php?cmnd=stop"); UpdateDisplay(); });
$('#prev').click(function(){ $.get("rpc.php?cmnd=prev"); UpdatePlaylist(); UpdateDisplay(); });
$('#next').click(function(){ $.get("rpc.php?cmnd=next"); UpdatePlaylist(); UpdateDisplay(); });
$('#seekm').click(function(){ $.get("rpc.php?sk=m10"); UpdateDisplay(); });
$('#seekp').click(function(){ $.get("rpc.php?sk=p10"); UpdateDisplay(); });

$('#shuffle').click(function(){ $.get("rpc.php?cmnd=shuffle"); UpdateDisplay(); });
$('#repall').click(function(){ $.get("rpc.php?cmnd=repeat"); UpdateDisplay(); });
$('#repsin').click(function(){ $.get("rpc.php?cmnd=single"); UpdateDisplay(); });
$('#random').click(function(){ $.get("rpc.php?cmnd=random"); UpdateDisplay(); });
$('#consume').click(function(){ $.get("rpc.php?cmnd=consume"); UpdateDisplay(); });

$('#clear').click(function(){ $.get("rpc.php?cmnd=clear"); UpdateDisplay(); });

$("#display").click(function(){ UpdateDisplay(); });

$('#volume').change(function(){ var volume = $(this).val(); $.get("rpc.php?vlm=" + volume); });

$('#listplaylist').change(function(){ var plstname = $(this).val(); $.get("rpc.php?ptpl=" + plstname); UpdatePlaylist(); UpdateDisplay(); });

$('#find').click(function(){ var findtxt = $('#search').val(); $.get("rpc.php?fndd=" + findtxt); UpdatePlaylist(); });

$("div").on("click", ".plstitem", function(){
	var pnpl = $(this).children("span.number").text();
	$.get("rpc.php?pnpl="+pnpl);
	UpdatePlaylist();
	UpdateDisplay();
});


UpdatePlaylist();
UpdateDisplay();

setInterval(function() {
	UpdatePlaylist();
	UpdateDisplay();
}, 15000);

});