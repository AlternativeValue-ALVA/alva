<?php
require('app/head_p.php');
$user_id = $get;
if ($user_id != '') 
{
    if (!ctype_alnum($user_id))
	{
        die;
    }
    $user_id = $qls->User->username_to_id($user_id);
    $result  = $qls->SQL->select
	('*', 'users', array
		(
			'id' => array(
				'=',
				$user_id
			)
		)
	);
    $row = $qls->SQL->fetch_array($result);
    require("app/profile_tudji.php");
} else 
{
    require("app/profile_moj.php");
}
?>