<?php
define('QUADODO_IN_SYSTEM', true);
$site = 'http://' . $_SERVER['HTTP_HOST'];
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
$za = filter_var($_POST['za'],FILTER_SANITIZE_SPECIAL_CHARS);
$naslov = filter_var($_POST['naslov'],FILTER_SANITIZE_SPECIAL_CHARS);
$poruka = filter_var($_POST['poruka'],FILTER_SANITIZE_SPECIAL_CHARS);
$datetime = date("d/m/y h:i:s");
$ko       = $qls->user_info['username'];

$columns = array(
	'tekst',
	'naslov',
	'ko',
	'kome',
	'datetime',
	'tip'
);
$values  = array(
	$poruka,
	$naslov,
	$ko,
	$za,
	$datetime,
	0
);
$qls->SQL->insert('pm', $columns, $values);
header('Location: ' . $site . '/inbox');
?>