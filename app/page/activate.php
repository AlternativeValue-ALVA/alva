<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
if ($qls->user_info['username'] == '')
{
	if ($qls->config['activation_type'] == 1)
	{
		if ($qls->User->activate_user())
		{
			echo ACTIVATE_SUCCESS;
		}
		else
		{
			echo $qls->User->activate_error;
		}
	}
	elseif ($qls->config['activation_type'] == 2)
	{
		echo "Potrebno je da admin verifikuje vas korisnicki racun";
	}
	else
	{
		echo ACTIVATE_NO_NEED;
	}
}
else
{
	echo ACTIVATE_ALREADY_LOGGED;
}
?>