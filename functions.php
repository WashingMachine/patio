<?php
include('config.php');

function connect($sql) {   
    global $db_host;
	global $db_user;
	global $db_pwd;
	global $db_name;

    if (!($conn=mysql_connect($db_host, $db_user, $db_pwd)))  { 
       printf("error connecting to DB by user = $db_user and pwd= $db_pwd"); 
       exit; 
    }
	mysql_set_charset('utf8',$conn);
    $db=mysql_select_db($db_name,$conn) or die("Unable to connect to database"); 
    
    $result = mysql_query($sql, $conn)or die("Unable to query database <b>". mysql_error()."</b><br>$sql"); 
    if (!$result){ 
        echo "database query failed."; 
    }else{ 
        return $result; 
    }
	mysql_close($conn);
}

function mysql_escape_mimic($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
    } 

    return $inp; 
}

function to_utf8( $string ) { 
// From http://w3.org/International/questions/qa-forms-utf-8.html 
    if ( preg_match('%^(?: 
      [\x09\x0A\x0D\x20-\x7E]            # ASCII 
    | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte 
    | \xE0[\xA0-\xBF][\x80-\xBF]         # excluding overlongs 
    | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte 
    | \xED[\x80-\x9F][\x80-\xBF]         # excluding surrogates 
    | \xF0[\x90-\xBF][\x80-\xBF]{2}      # planes 1-3 
    | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15 
    | \xF4[\x80-\x8F][\x80-\xBF]{2}      # plane 16 
)*$%xs', $string) ) { 
        return $string; 
    } else { 
        return iconv( 'CP1252', 'UTF-8', $string); 
    } 
}

function jsonmethodcall($json) {
	global $hostjsonrpc;  
	global $username; 
	global $password;
	
		$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); 
			curl_setopt($ch, CURLOPT_POST          ,1); 
			curl_setopt($ch, CURLOPT_URL           ,$hostjsonrpc); 
			curl_setopt($ch, CURLOPT_USERPWD       ,"$username:$password"); 
			curl_setopt($ch, CURLOPT_POSTFIELDS    ,$json); 
			$json = curl_exec($ch); 
		curl_close($ch);     

	return $json;

}

	//get active or inactive players
	$request = '{"jsonrpc": "2.0", "method": "Player.GetActivePlayers", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);

echo "<br>";

if(!empty($_GET['id'])) {

if ($_GET['id'] == 'AudioPlaylist.Play') {
  //prepare the field values being posted to the service
  	$request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.Play", "id": 1}';
  	$curl = jsonmethodcall($request);
  	$array = json_decode($curl,true);
}

if ($_GET['id'] == 'AudioPlaylist.SkipPrevious') {
  //audio skip previous
  	$request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.SkipPrevious", "id": 1}';
  	$curl = jsonmethodcall($request);
  	$array = json_decode($curl,true);

  //video skip previous
  	$request = '{"jsonrpc": "2.0", "method": "VideoPlaylist.SkipPrevious", "id": 1}';
  	$curl = jsonmethodcall($request);
  	$array = json_decode($curl,true);
}

if ($_GET['id'] == 'AudioPlaylist.SkipNext') {
  //audio skip next
  	$request = '{"jsonrpc": "2.0", "method": "AudioPlaylist.SkipNext", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);

  //video skip next
  	$request = '{"jsonrpc": "2.0", "method": "VideoPlaylist.SkipNext", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);
}

if ($_GET['id'] == 'AudioPlayer.PlayPause') {
  //audio play or pause
  	$request = '{"jsonrpc": "2.0", "method": "AudioPlayer.PlayPause", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);

  //video play or pause
  	$request = '{"jsonrpc": "2.0", "method": "VideoPlayer.PlayPause", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);
}

//Action Move up
if ($_GET['id'] == 'Action.Move.Up') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(3)", "r");
}

//Action Move down
if ($_GET['id'] == 'Action.Move.Down') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(4)", "r");
}

//Action Move left
if ($_GET['id'] == 'Action.Move.Left') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(1)", "r");
}

//Action Move right
if ($_GET['id'] == 'Action.Move.Right') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(2)", "r");
}

//Action Select
if ($_GET['id'] == 'Action.Select') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(7)", "r");
}

//Action Previous
if ($_GET['id'] == 'Action.Previous') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(10)", "r");
}

//Action Show Info
if ($_GET['id'] == 'Action.Show.Info') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(11)", "r");
}

//Action Show Info
if ($_GET['id'] == 'Action.Context') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(117)", "r");
}

//Action Show Info
if ($_GET['id'] == 'Action.Stop') {
  fopen("$host_http/xbmcCmds/xbmcHttp?command=Action(13)", "r");
}

}

  //get current volume
	$request = '{"jsonrpc": "2.0", "method": "XBMC.GetVolume", "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);

  //increase and decrease volumes
  	$decreasevolume = $array['result'] - 5;
  	$increasevolume = $array['result'] + 5;

if(!empty($_GET['id'])) {

//incease volume
if ($_GET['id'] == 'Increase.Volume') {
	$request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $increasevolume . ', "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);
}

//decrease volume
if ($_GET['id'] == 'Decrease.Volume') {
	$request = '{"jsonrpc": "2.0", "method": "XBMC.SetVolume", "params": ' . $decreasevolume . ', "id": 1}';
	$curl = jsonmethodcall($request);
	$array = json_decode($curl,true);
}

}
