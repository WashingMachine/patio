<?php
include('config.php');

function connect($sql) 
{   
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

function getThumbs()
{
	include('scripts/smb.php');
	include('scripts/simpleImage.php');
	
	global $smb_user;
	global $smb_pass;
	global $movie_thumb;
	global $movie_fanart;
	global $tvshow_thumb;
	global $tvshow_fanart;
	$smb = 'smb://';
	$ext = '.jpg';
	
	if(substr($movie_thumb, -1) != "/") $movie_thumb .= "/";
	if(substr($movie_fanart, -1) != "/") $movie_fanart .= "/";
	if(substr($tvshow_thumb, -1) != "/") $tvshow_thumb .= "/";
	if(substr($tvshow_fanart, -1) != "/") $tvshow_fanart .= "/";
					
	$result = connect("SELECT c22 FROM movie");
	$num = mysql_numrows($result);

	for($i=0; $i<$num; $i++)
	{
	        $path = mysql_result($result,$i, "c22");
			$tmp = substr($path, 6);

			$smb_host = strtok($tmp, "/");
			$smb_share = strtok("/");
			$smb_dir = strtok("/");
			$name = strtok("/");

			$new_path = $smb.$smb_user.":".$smb_pass."@".$smb_host."/".$smb_share."/".$smb_dir."/".$name."/";
			$path_thumb = $new_path.'movie'.$ext;
			$path_fanart = $new_path.'fanart'.$ext;

			if(!file_exists($cache_thumb = $movie_thumb.$name.$ext))
			{
				$image = new SimpleImage();
				$image->load($path_thumb);
				$image->resize(130,200);
				$image->save($cache_thumb);
			}

			if(!file_exists($cache_fanart = $movie_fanart.$name.$ext))
			{	
				copy($path_fanart, $cache_fanart);	
			}
	}
	
	mysql_free_result($result);
	
	$result = connect("SELECT c16 FROM tvshow");
	$num = mysql_numrows($result);

	for($i=0; $i<$num; $i++)
	{
	        $path = mysql_result($result,$i, "c16");
			$tmp = substr($path, 6);
			
			$smb_host = strtok($tmp, "/");
			$smb_share = strtok("/");
			$smb_dir = strtok("/");
			$name = strtok("/");
			
			$new_path = $smb.$smb_user.":".$smb_pass."@".$smb_host."/".$smb_share."/".$smb_dir."/".$name."/";
			$path_thumb = $new_path.'folder'.$ext;
			$path_fanart = $new_path.'fanart'.$ext;
			
			if(!file_exists($cache_thumb = $tvshow_thumb.$name.$ext))
			{
				$image = new SimpleImage();
				$image->load($path_thumb);
				$image->resize(130,200);
				$image->save($cache_thumb);
			}
			
			if(!file_exists($cache_fanart = $tvshow_fanart.$name.$ext))
			{	
				copy($path_fanart, $cache_fanart);	
			}	
	}

	mysql_free_result($result);
	mysql_close();
}

function getImages($dir)
  {
    global $imagetypes;

    // array to hold return value
    $retval = array();

	// add trailing slash if missing
	if(substr($dir, -1) != "/") $dir .= "/";
	
	// full server path to directory
    $fulldir = "{$_SERVER['DOCUMENT_ROOT']}/$dir";

	$d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read()))
	{
      // skip hidden files
      if($entry[0] == ".") continue;
	
      // check for image files
	  $finfo = finfo_open(FILEINFO_MIME_TYPE); 
	  $mime = finfo_file($finfo, "$fulldir$entry");

	  if(in_array($mime, $imagetypes))
	  {
        	$retval[] = array(
         		"file" => "/$dir$entry",
				"size" => getimagesize("$fulldir$entry")
        	);
      }
	  finfo_close($finfo);
    }
    $d->close();

    return $retval;
  }
?>