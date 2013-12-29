<?php
define('QUADODO_IN_SYSTEM', true);
$site = 'http://'.$_SERVER['HTTP_HOST'];
error_reporting(E_ALL ^ E_NOTICE);
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once('app/Blank.lang.php');
require_once('app/qls.class.php');
$qls = new qls(SYS_CURRENT_LANG);
$p   = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['page']);
$get = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['get']);
$get2 = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['get2']);
if (file_exists('app/page/' . $p . '.php')) {
 include 'app/page/' . $p . '.php';
} else {
 include 'app/page/glavna.php';
}
?>