<?php
include 'adodb5/adodb.inc.php';
$db['host'] 	= 'localhost';
$db['user'] 	= 'root';
$db['password'] = '';
$db['db_driver'] = 'mysqli';
$db['nama_db'] 	= 'duiro-indogo';
class System{
  function System(){
	  global $db;
	  $this->db 		= NewADOConnection($db['db_driver']);
	  if (!$this->db->Connect($db['host'] ,$db['user'] ,$db['password'],$db['nama_db'])){	
		die( mysql_error() . ' Error while connecting to Database Server');
	}
	$ADODB_FETCH_MODE 	= ADODB_FETCH_ASSOC;
  }  
} 
$system= new System;	  
?>