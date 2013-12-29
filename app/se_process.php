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
	echo $_POST['ime'];
	$ime     = filter_var($_POST['ime'], FILTER_SANITIZE_SPECIAL_CHARS);
	echo $ime."<br>";
	$prezime = filter_var($_POST['prezime'], FILTER_SANITIZE_SPECIAL_CHARS);
	$tel     = filter_var($_POST['telefon'], FILTER_SANITIZE_SPECIAL_CHARS);
	$zemlja  = filter_var($_POST['zemlja'], FILTER_SANITIZE_SPECIAL_CHARS);
	$about   = filter_var($_POST['about'], FILTER_SANITIZE_SPECIAL_CHARS);
	$user_id = $qls->User->username_to_id($user_id);
	$result  = $qls->SQL->select('*', 'users', array(
		'id' => array(
			'=',
			$user_id
		)
	));
	$row     = $qls->SQL->fetch_array($result);
	if(empty($ime))
	{
		$ime = $row['firstname'];
		echo $ime."-<br>";
	}
	if (empty($prezime))
	{
		$prezime = $row['lastname'];
	}
	if (empty($tel))
	{
		$tel = $row['phone'];
	}
	if (empty($zemlja))
	{
		$zemlja = $row['country'];
	}
	if (empty($about))
	{
		$about = $row['about'];
	}
	echo $ime."a<br>";
	$qls->SQL->update('users', array(
		'firstname' => $ime,
		'lastname' => $prezime,
		'phone' => $tel,
		'country' => $zemlja,
		'about' => $about
	), array(
		'id' => array(
			'=',
			$qls->User->username_to_id($qls->user_info['username'])
		)
	));
	echo $ime."d<br>";
//	header('Location: ' . $site . '/profile');
?>