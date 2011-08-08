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

<?php
	include('config.php');
	include('functions.php');
	
	$tmp = to_utf8( $_GET['name'] );
	//$tmp = $_GET['name'];
	$type = $_GET['type'];

	if($type == "movie")
	{
		$name = substr($tmp, 0, -11);
		$mysql_name = mysql_escape_mimic($name);
		if(substr($movie_fanart, -1) != "/") $movie_fanart .= "/";
		$path = $movie_fanart.$tmp;
		//printf("%s <br>\r\n", $name);
		//printf("%s <br>\r\n", $path);

		$result = connect("SELECT c00,c01,c02,c04,c05,c11,c15,strPath,strFileName FROM movieview WHERE c22 LIKE '%$mysql_name%' OR c00 LIKE '%$mysql_name%'");
		$row = mysql_fetch_row($result);
	}
	else
	{
		$name = substr($tmp, 0, -4);
		$mysql_name = mysql_escape_mimic($name);
		if(substr($tvshow_fanart, -1) != "/") $tvshow_fanart .= "/";
		$path = $tvshow_fanart.$tmp;
		
		$result = connect("SELECT c00,c01,c04,c12,c13,c14 FROM tvshow WHERE c16 LIKE '%$mysql_name%'");
		$row = mysql_fetch_row($result);
	}	
?>

<body>
		<img id="background" src="<?php echo $path?>" width="100%" height="100%">
			
	<div id="title">
		<h1><?php echo $row[0]?></h1>
	</div>
	
		<div id="plot">
			<?php
				if($row[1] == "")
				{
					echo "<p>$row[2]</p>";
				}
				else
				{
					echo "<p>$row[1]</p>";	
				}
			?>
		</div>

				<div id="details">
				<?php
					if($type == "movie")
					{
						$file = $row[7].$row[8];
						//echo "<p>$file</p>";
						$rating = floatval($row[4]);
						echo "<p>Rating: $rating Votes: $row[3] Runtime: $row[5] Director: $row[6]</p>";
					}
					else
					{
						$rating = floatval($row[2]);
						echo "<p>Rating: $rating Votes: $row[3] MPAA: $row[4] Studio: $row[5]</p>";
					}
				?>
				</div>
		
		<div id="control">
			<div id="play">
				<a href = 'xbmc_play.php?file=<?php echo($file);?>'> <img src = 'images/play.png' /> </a>
				   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
				   <script>
				     $(document).ready(function(){
				       $("a").click(function(event){
				       });
				     });
				   </script>
			</div>
		</div>
		
		<div id="footer">
			<a href="javascript:history.go(-1);">
				<img src = "images/back.png" />
			</a>
		</div>

</body>
</html>