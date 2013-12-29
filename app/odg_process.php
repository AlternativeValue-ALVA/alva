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
}
$id     = $_POST['id'];
$sql    = "SELECT MAX(o_id) AS r_id FROM qls3_odgovori WHERE pitanje_id='$id'";
$result = mysql_query($sql);
$rows   = mysql_fetch_array($result);
if ($rows)
{
	$maxid = $rows['r_id'] + 1;
}
else
{
	$maxid = 1;
}
if(($rows['zakljucana'] == 0)) 
{
$odg       = $_POST['o_odgovor'];
$user_name = $qls->user_info['username'];
$datetime  = date("d/m/y H:i:s");
$sql2      = "INSERT INTO qls3_odgovori(pitanje_id, o_id, o_uid, o_odgovor, o_datetime)VALUES('$id', '$maxid', '$user_name', '$odg', '$datetime')";
$result2   = mysql_query($sql2);
if ($result2)
{
	$sql3    = "UPDATE qls3_pitanja SET reply='$maxid' WHERE id='$id'";
	$result3 = mysql_query($sql3);
	$sql    = "SELECT posts FROM qls3_users WHERE username='$user_name'";
	$uzer = mysql_query($sql);
	$rows   = mysql_fetch_array($uzer);
	if ($rows)
	{
		$postovi = $rows['posts'] + 1;
	}
	else
	{
		$postovi = 1;
	}
	$sql4    = "UPDATE ql3s_users SET postovi='$postovi' WHERE username='$user_name'";
	$result4 = mysql_query($sql3);
	header('Location: ' . $site . '/topic/' . $id);
}
else
{
	echo "GRESKA";
}
}
else
{
	echo "OVA TEMA JE ZAKLJUCANA :/ Nemozes odg na to ...";
}
?>