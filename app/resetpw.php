<?php
define('QUADODO_IN_SYSTEM', true);
$site = 'http://' . $_SERVER['HTTP_HOST'];
error_reporting(E_ALL ^ E_NOTICE);
$get2 = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['c']);
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('Blank.lang.php');
require_once('qls.class.php');
$qls = new qls(SYS_CURRENT_LANG);
if ($qls->user_info['username'] != '')
{
	header('Location: ' . $site . '/home');
	die;
}
if (isset($_POST['process']))
{
	if ($qls->User->change_password())
	{
		header('Location: ' . $site . '/amnesia/resetpwok');
	}
	else
	{
		header('Location: ' . $site . '/amnesia/resetpwwrong/' . $get2);
	}
}
else
{
	header('Location: ' . $site . '/amnesia/resetpw/' . $get2);
}
?>