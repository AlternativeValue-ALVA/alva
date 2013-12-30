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
$naslov = filter_var($_POST['naslov'],FILTER_SANITIZE_SPECIAL_CHARS);
$opis = filter_var($_POST['opis'],FILTER_SANITIZE_SPECIAL_CHARS);
$cena = filter_var($_POST['cena'],FILTER_SANITIZE_SPECIAL_CHARS);
$tagovi = filter_var($_POST['tagovi'],FILTER_SANITIZE_SPECIAL_CHARS);
$uid      = $qls->user_info['username'];
$datetime = date("d/m/y h:i:s");
$id       = md5($qls->user_info['username']);
if (empty($_FILES['slika']['tmp_name']))
{
	die("morate postaviti sliku");
}

include_once('phpthumb/ThumbLib.inc.php');
if (!getimagesize($_FILES['slika']['tmp_name']))
{
	die("Greska: Nije slika");
}
$imgtype = array(
	'1' => '.gif',
	'2' => '.jpg',
	'3' => '.png'
);
list($width, $height, $type, $attr) = getimagesize($_FILES['slika']['tmp_name']);
switch ($type)
{
	case 1:
		$ext = '.gif';
		break;
	case 2:
		$ext = '.jpg';
		break;
	case 3:
		$ext = '.png';
		break;
}
if ($ext == '.gif')
{
	die("Greska - GIF nije dozvoljen. Molimo vas koristite samo PNG ili JPEG format");
}
if ($width > 10000 || $height > 10000)
{
	die("Greska: Maximalna duzina i visina su prevazidjeni (max 10000x10000px)");
}
if ($_FILES['slika']['size'] > 500000)
{
	die("Greska: prevelik fajl (max 5mb)");
}
$uploaddir  = '../crc/';
$uploadfile = $uploaddir . "" . md5($datetime) . "" . rand(99999, 999999) . ".jpg";
//echo $uploadfile;
if (!move_uploaded_file($_FILES['slika']['tmp_name'], $uploadfile))
{
	die("Greska prilikom pomeranja fajla");
}
$thumb = PhpThumbFactory::create($uploadfile);
$thumb->resize(600, 300);
$thumb->save($uploadfile);
$columns = array(
	'naslov',
	'slika',
	'opis',
	'cena',
	'uid',
	'datetime'
);
$values  = array(
	$naslov,
	$uploadfile,
	$opis,
	$cena,
	$uid,
	$datetime
);
$qls->SQL->insert('resursi', $columns, $values);
header('Location: ' . $site . '/profile');
?>