<?php

require('config.php');
include('functions.php');

$tmp = to_utf8( $_GET['file'] );

$json = '{"jsonrpc": "2.0", "method": "XBMC.Play", "params": { "file": "'.$tmp.'" }, "id": 1}';

$curl = jsonmethodcall($json);

//echo $curl;

header( 'Location: remote.php' ) ;

?>