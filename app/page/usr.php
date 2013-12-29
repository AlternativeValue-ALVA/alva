<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
}
if (($get == "obrisir"))
{
	if (!is_numeric($get2))
	{
		echo "KAKO DA NIJE BROJ ?!";
		die;
	}
	$result = $qls->SQL->select('*', 'resursi', array(
		'id' => array(
			'=',
			$get2
		)
	));
	$row    = $qls->SQL->fetch_array($result);
	if (($row['uid'] == $qls->user_info['username']))
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
			die;
		}
	}
	else
	{
		echo "Ovo nije vas resurs :)";
		die;
	}
}
if (($get == "vratir"))
{
	if (!is_numeric($get2))
	{
		die;
	}
	$result = $qls->SQL->select('*', 'resursi', array(
		'id' => array(
			'=',
			$get2
		)
	));
	$row    = $qls->SQL->fetch_array($result);
	if (($row['uid'] == $qls->user_info['username']))
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
			die;
		}
	}
	else
	{
		echo "Ovo nije vas resurs :)";
		die;
	}
}
if (($get == "updateprofile"))
{
	$ime     = filter_var($_POST['ime'], FILTER_SANITIZE_SPECIAL_CHARS);
	$prezime = filter_var($_POST['prezime'], FILTER_SANITIZE_SPECIAL_CHARS);
	$tel     = filter_var($_POST['telefon'], FILTER_SANITIZE_SPECIAL_CHARS);
	$zemlja  = filter_var($_POST['zemlja'], FILTER_SANITIZE_SPECIAL_CHARS);
	$grad  = filter_var($_POST['grad'], FILTER_SANITIZE_SPECIAL_CHARS);
	$ulica  = filter_var($_POST['ulica'], FILTER_SANITIZE_SPECIAL_CHARS);
	$about   = filter_var($_POST['about'], FILTER_SANITIZE_SPECIAL_CHARS);
	$user_id = $qls->User->username_to_id($qls->user_info['username']);
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
	if (empty($grad))
	{
		$grad = $row['city'];
	}
	if (empty($ulica))
	{
		$ulica = $row['street'];
	}
	if (empty($about))
	{
		$about = $row['about'];
	}
	$qls->SQL->update('users', array(
		'firstname' => $ime,
		'lastname' => $prezime,
		'phone' => $tel,
		'country' => $zemlja,
		'city' => $grad,
		'street' => $ulica,
		'about' => $about
	), array(
		'id' => array(
			'=',
			$qls->User->username_to_id($qls->user_info['username'])
		)
	));
	header('Location: ' . $site . '/profile');
}
if (($get == "securty"))
{
	$gradh = filter_var($_POST['gradh'], FILTER_SANITIZE_SPECIAL_CHARS);
	$ulicah = filter_var($_POST['ulicah'], FILTER_SANITIZE_SPECIAL_CHARS);
	$telh = filter_var($_POST['brojh'], FILTER_SANITIZE_SPECIAL_CHARS);
	$godineh = filter_var($_POST['godineh'], FILTER_SANITIZE_SPECIAL_CHARS);
	$user_id = $qls->User->username_to_id($qls->user_info['username']);
	$result  = $qls->SQL->select('*', 'users', array(
		'id' => array(
			'=',
			$user_id
		)
	));
	$row = $qls->SQL->fetch_array($result);
	$qls->SQL->update('users', array(
		'gradh' => $gradh,
		'ulicah' => $ulicah,
		'telefonh' => $telh,
		'godineh' => $godineh
	), array(
		'id' => array(
			'=',
			$qls->User->username_to_id($qls->user_info['username'])
		)
	));
	header('Location: ' . $site . '/profile');
}
if (($get == "obrisipm"))
{
	if (!is_numeric($get2))
	{
		die;
	}
	$result  = $qls->SQL->select('*', 'pm', array(
		'id' => array(
			'=',
			$get2
		)
	));
	$row = $qls->SQL->fetch_array($result);
	if($row['kome'] == $qls->user_info['username'])
	{
		$qls->SQL->update('pm', array(
			'obrisana' => 1
		), array(
			'id' => array(
				'=', $get2
				
			)
		));
	}
	header('Location: ' . $site . '/inbox');
}
?>
