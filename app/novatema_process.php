<?php
define('QUADODO_IN_SYSTEM', true);
$site = 'http://'.$_SERVER['HTTP_HOST'];
error_reporting(E_ALL ^ E_NOTICE);
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('Blank.lang.php');
require_once('qls.class.php');
$qls = new qls(SYS_CURRENT_LANG);
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
	die;
}
$naslov   = $_POST['naslov'];
$tekst    = $_POST['tekst'];
$uid      = $qls->user_info['username'];
$datetime = date("d/m/y h:i:s");
$columns  = array(
	'naslov',
	'tekst',
	'uid',
	'datetime'
);
$values   = array(
	$naslov,
	$tekst,
	$uid,
	$datetime
);
$qls->SQL->insert('pitanja', $columns, $values);
header('Location: ' . $site . '/board');
?>