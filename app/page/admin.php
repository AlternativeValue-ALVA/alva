<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
}
if ($qls->user_info['auth_admin'] != 1)
{
	header('Location: ' . $site . '/');
}
$get  = $_GET['get'];
$get  = preg_replace("/[^a-zA-Z0-9]+/", "", $get);
$get2 = $_GET['get2'];
$get2 = preg_replace("/[^a-zA-Z0-9]+/", "", $get2);
if (($get == "odobrik"))
{
	if ($qls->user_info['auth_admin_activate_account'] == 1)
	{
		if ($get2 > 0)
		{
			$qls->SQL->update('users', array(
				'active' => 'yes'
			), array(
				'id' => array(
					'=',
					$get2
				)
			));
			header('Location: ' . $site . '/members');
		}
		else
		{
			echo "ID nemoze biti" . $get2 . "";
		}
	}
	else
	{
		echo "Nemate permisije za odobravanje korisnickih racuna :)";
	}
}
if (($get == "uklonit"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('transakcije', array(
			'odobrena' => '0'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		
		$sqls  = $qls->SQL->select('*', 'transakcije', array
			(
				'id' => array(
					'=',
					$get2
				)
			)
		);
		
		$rowx = $qls->SQL->fetch_array($sqls);
		$ko = $rowx['idko'];
		$kome = $rowx['idkome'];
		$kolko = $rowx['kolko'];
		
		$result  = $qls->SQL->select
		('*', 'users', array
			(
				'id' => array(
					'=',
					$kome
				)
			)
		);
		$rowa = $qls->SQL->fetch_array($result);
		$komea = $rowa['alve'];
		$komea = $komea - $kolko;
		$prima = $rowa['primljene'] - $koliko;
		
		$qls->SQL->update('users', array(
			'alve' => $komea,
			'primljene' => $prima
		), array(
			'id' => array(
				'=',
				$kome
			)
		));
		
		$wwwe  = $qls->SQL->select
		('*', 'users', array
			(
				'id' => array(
					'=',
					$ko
				)
			)
		);
		$ddd = $qls->SQL->fetch_array($wwwe);
		$koa = $ddd['alve'];
		$koa = $koa + $kolko;
		$kob = $ddd['poslate'] - $kolko;
		$qls->SQL->update('users', array(
			'alve' => $koa,
			'poslate' => $kob
		), array(
			'id' => array(
				'=',
				$ko
			)
		));
		header('Location: ' . $site . '/trans/tid' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
if (($get == "odobrit"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('transakcije', array(
			'odobrena' => '1'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		
		$sqls  = $qls->SQL->select('*', 'transakcije', array
			(
				'id' => array(
					'=',
					$get2
				)
			)
		);
		
		$rowx = $qls->SQL->fetch_array($sqls);
		$ko = $rowx['idko'];
		$kome = $rowx['idkome'];
		$kolko = $rowx['kolko'];
		
		$result  = $qls->SQL->select
		('*', 'users', array
			(
				'id' => array(
					'=',
					$kome
				)
			)
		);
		$rowa = $qls->SQL->fetch_array($result);
		$komea = $rowa['alve'];
		$komea = $komea + $kolko;
		$prima = $rowa['primljene'] + $koliko;
		
		$qls->SQL->update('users', array(
			'alve' => $komea,
			'primljene' => $prima
		), array(
			'id' => array(
				'=',
				$kome
			)
		));
		
		$wwwe  = $qls->SQL->select
		('*', 'users', array
			(
				'id' => array(
					'=',
					$ko
				)
			)
		);
		$ddd = $qls->SQL->fetch_array($wwwe);
		$koa = $ddd['alve'];
		$koa = $koa - $kolko;
		$kob = $ddd['poslate'] + $kolko;
		$qls->SQL->update('users', array(
			'alve' => $koa,
			'poslate' => $kob
		), array(
			'id' => array(
				'=',
				$ko
			)
		));
		header('Location: ' . $site . '/trans/tid' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
if (($get == "obrisir"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('resursi', array(
			'obrisana' => '1'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		header('Location: ' . $site . '/res/rid' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
if (($get == "vratir"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('resursi', array(
			'obrisana' => '0'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		header('Location: ' . $site . '/res/rid' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
if (($get == "lockp"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('pitanja', array(
			'zakljucana' => '1'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		header('Location: ' . $site . '/topic/' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
if (($get == "unlockp"))
{
	if ($get2 > 0)
	{
		$qls->SQL->update('pitanja', array(
			'obrisana' => '0'
		), array(
			'id' => array(
				'=',
				$get2
			)
		));
		header('Location: ' . $site . '/topic/' . $get2 . '');
	}
	else
	{
		echo "ID nemoze biti" . $get2 . "";
	}
}
?>