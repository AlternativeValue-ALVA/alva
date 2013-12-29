<?php
define('QUADODO_IN_SYSTEM', true);
$site = 'http://'.$_SERVER['HTTP_HOST'];
error_reporting(E_ALL ^ E_NOTICE);
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('Blank.lang.php');
require_once('qls.class.php');
$qls = new qls(SYS_CURRENT_LANG);
if (isset($_POST['process'])) 
{
	if ($qls->User->login_user()) 
	{
	//	echo "x";
		header( 'Location: '.$site.'/home' );
	}
	else 
	{
	//	echo "r";
	  // header( 'Location: '.$site.'/login/'.$error );
	}
}
else 
{
	//echo "Y";
   header( 'Location: '.$site.'/login/' );
}
?>