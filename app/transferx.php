<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;
}
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
	die;
}
$user_id = $_POST['user'];
$alve    = $_POST['alve'];
$ffd     = $_POST['alve'];
$razlog  = $_POST['razlog'];
function is_int_val($data)
{
	if (is_int($data) === true)
		return true;
	elseif (is_string($data) === true && is_numeric($data) === true)
	{
		return (strpos($data, '.') === false);
	}
	return false;
}
if (!is_int_val($alve))
{
	header('Location: ' . $site . '/profile/' . $user_id);
}
if ($alve < 0)
{
	header('Location:  ' . $site . '/profile/' . $user_id);
}
$alve = preg_replace("/[^0-9]/", "", $alve);
preg_match_all('/[\\d,]/', $alve, $alve, PREG_PATTERN_ORDER);
$alve = implode('', $alve[0]);
if (preg_match('/^,*(\\d.*?\\d),*$/', $alve, $regs))
{
	$alve = $regs[1];
}
$user_id = $qls->User->username_to_id($user_id);
$result  = $qls->SQL->select('*', 'users', array(
	'id' => array(
		'=',
		$user_id
	)
));
$row     = $qls->SQL->fetch_array($result);
$alves   = $alve + $row['alve'];
$alveg   = $row['primljene'] + $alve;
$qls->SQL->update('users', array(
	'primljene' => $alveg,
	'alve' => $alves
), array(
	'id' => array(
		'=',
		$user_id
	)
));
$rrrr  = $qls->user_info['username'];
$alved = $_POST['alve'];
$rrrr  = $qls->User->username_to_id($rrrr);
$dd    = $qls->SQL->select('*', 'users', array(
	'id' => array(
		'=',
		$rrrr
	)
));
$ww    = $qls->SQL->fetch_array($dd);
$alr   = $ww['alve'];
$alves = $alr - $alve;
$alvez = $ww['poslate'] + $alved;
$qls->SQL->update('users', array(
	'poslate' => $alvez,
	'alve' => $alves
), array(
	'id' => array(
		'=',
		$rrrr
	)
));
$columns = array(
	'idko',
	'idkome',
	'kolko',
	'zasto',
	'odobrena',
	'tip'
);
$idko    = $qls->User->username_to_id($qls->user_info['username']);
$kome    = $_POST['user'];
$idkome  = $qls->User->username_to_id($kome);
$values  = array(
	$idko,
	$idkome,
	$ffd,
	$razlog,
	1,
	1
);
$qls->SQL->insert('transakcije', $columns, $values);
header('Location: ' . $site .'/profile/'. $kome);
?>