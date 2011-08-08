<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>.: Patio, a PHP/MySQL frontend for XBMC :.</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

<script type="application/javascript" src="iscroll.js"></script>

<script type="text/javascript">

function loaded() {
	var scrollContent = new iScroll('wrapper');
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

window.addEventListener('DOMContentLoaded', setTimeout(function () { loaded(); }, 200), false);

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript">
function recp(id) {
  $('#mijnpagina').load('functions.php?id=' + id);
}
</script>
</head>
<body>
	
	<div id="wrapper">
		<div id="scroller">
			<ul id="thelist">
				<?php

				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";

				echo "<center>";
				echo "<a href=\"#\" onClick=\"recp('Action.Stop')\"><img src=\"images/media28-stop.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Move.Up')\"><img src=\"images/arrow3-up.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Context')\"><img src=\"images/letter-c.png\"></a><br>\n";

				echo "<a href=\"#\" onClick=\"recp('Action.Move.Left')\"><img src=\"images/arrow3-left.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Select')\"><img src=\"images/word-ok.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Move.Right')\"><img src=\"images/arrow3-right.png\"></a><br>\n";

				echo "<a href=\"#\" onClick=\"recp('Action.Previous')\"><img src=\"images/arrow-redo.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Move.Down')\"><img src=\"images/arrow3-down.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Action.Show.Info')\"><img src=\"images/information.png\"></a><br><br>\n";
				echo "</center>";

				echo "<center>";

				//TODO: play button when song is paused, paused button when song is playing.
				//if (($array['result']['paused']) == 1) {echo "Song paused"; echo "<br><br>"; } else { echo "Playing"; echo "<br><br>"; }
				echo "<a href=\"#\" onClick=\"recp('AudioPlayer.PlayPause')\"><img src=\"images/play-pause-sign.png\"></a><br>\n";
				echo "<a href=\"#\" onClick=\"recp('Decrease.Volume')\"><img src=\"images/volume-left.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('AudioPlaylist.SkipPrevious')\"><img 		src=\"images/arrows-skip-backward.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('AudioPlaylist.SkipNext')\"><img src=\"images/arrows-skip-forward.png\"></a>\n";
				echo "<a href=\"#\" onClick=\"recp('Increase.Volume')\"><img src=\"images/volume-right.png\"></a><br>\n";

				echo "<div id='mijnpagina'></div>";

				?>

		</div>
	</div>
	
	<div id="footer">
		<a href="javascript:history.go(-1);">
			<img src = "images/back.png" />
		</a>
	</div>
	
</body>
</html>