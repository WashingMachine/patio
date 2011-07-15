<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<title>:.Patio, a PHP/MySQL frontend for XBMC.:</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

<script type="application/javascript" src="scripts/iscroll.js"></script>

<script type="text/javascript">

function loaded() {
	var scrollContent = new iScroll('wrapper');
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

window.addEventListener('DOMContentLoaded', setTimeout(function () { loaded(); }, 200), false);

</script>

</head>
<body>

<div id="wrapper">
	<div id="scroller">
		<ul id="thelist">
	</div>
</div>
<div id="footer">
	<a href = "movies.php">
		<img src = "images/movies.png" />
	</a>
	<a href = "tvshows.php">
		<img src = "images/tvshows.png" />
	</a>	
</div>

</body>
</html>