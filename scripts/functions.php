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