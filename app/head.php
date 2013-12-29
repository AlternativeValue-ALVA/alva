<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;	
}
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
}
$usr = $qls->user_info['username'];
?><!DOCTYPE html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--><html><!--<![endif]-->
<head>
	<title>ALVA</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="Alternativna Valuta" name="description" />
	<meta content="Momcilo m0k1 Micanovic" name="author" />
	<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/metro.css" rel="stylesheet" />
	<link href="/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="/assets/css/style.css" rel="stylesheet" />
	<link href="/assets/css/style_responsive.css" rel="stylesheet" />
	<link href="/assets/css/style_default.css" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="/assets/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" type="text/css" href="/assets/uniform/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap-daterangepicker/daterangepicker.css" />
	<link href="/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="/assets/bootstrap-tag/css/bootstrap-tag.css" rel="stylesheet" type="text/css">
	<link href="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css">
	<link href="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css">
	<link href="/assets/css/inbox.css" rel="stylesheet" type="text/css" />

</head>
<body class="fixed-top">
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/home">
				<img src="/assets/img/logo.png" alt="logo" />
				</a>
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="/assets/img/menu-toggler.png" alt="" />
				</a>          			
				<ul class="nav pull-right">
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-warning-sign"></i>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>Nemate novih notifikacija</p>
							</li>
							<?php
							/*
							<li>
								<a href="#">
								<span class="label label-success"><i class="icon-plus"></i></span>
								New user registered. 
								<span class="time">Just now</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								Server #12 overloaded. 
								<span class="time">15 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-warning"><i class="icon-bell"></i></span>
								Server #2 not respoding.
								<span class="time">22 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-info"><i class="icon-bullhorn"></i></span>
								Application error.
								<span class="time">40 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								Database overloaded 68%. 
								<span class="time">2 hrs</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								2 user IP blocked.
								<span class="time">5 hrs</span>
								</a>
							</li>
							<li class="external">
								<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
							</li>
							*/ ?>
						</ul>
					</li>
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope-alt"></i>
						<span class="badge"><?php
$d = 0;
$perpage      = 99;
$page         = 1;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pm` WHERE (kome = '$usr' AND procitana = '0') ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($row = $qls->SQL->fetch_array($users_result))
{
	$d = $d + 1;	
}
if($d > 0)
{
	echo $d;
}
?></span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>INBOX</p>
							</li>
				<?php
$perpage      = 10;
$page         = 1;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pm`WHERE (kome = '$usr') ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($row = $qls->SQL->fetch_array($users_result))
{
?>
		<li>
								<a href="/poruka/<?php echo $row['id']; ?>">
								<span class="photo"><img src="/crc/<?php echo md5($row['ko']);?>_s.jpg" alt="" /></span>
								<span class="subject">
								<span class="from"><?php echo $row['ko']; ?></span>
								</span>
								<span class="message">
								<?php echo substr($rows['tekst'], 0, 50); ?>
								</span>  
								</a>
							</li>
<?php
}
?>
							<li class="external">
								<a href="/inbox">Proveri sve poruke <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li >
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="/crc/<?php echo md5($qls->user_info['username']);?>_s.jpg" alt="" />
						<span class="username"><?php echo $qls->user_info['username']; ?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/profile"><i class="icon-user"></i> Moj Profil</a></li>
							<li><a href="#"><i class="icon-cog"></i> Opcije</a></li>
							<li class="divider"></li>
							<li><a href="/logout"><i class="icon-key"></i> Odjavi se</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="page-container row-fluid">
		<div class="page-sidebar nav-collapse collapse">
			<form class="sidebar-search" />
				<div class="input-box">
					<input type="text" class="" placeholder="Pretraga" />
					<input type="button" class="submit" value=" " />
				</div>
			</form>
			<div class="clearfix"></div>
			<ul class="page-sidebar-menu">
				<li class="active">
					<a href="/home">
					<i class="icon-home"></i> Home
					<span class="selected"></span>
					</a>					
				</li>
				<li class="has-sub">
					<a href="javascript:;" class="">
					<i class="icon-user"></i> Profil
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li><a class="" href="/profile">Moj Profil</a></li>
						<li><a class="" href="#">Izmeni Profil</a></li>
					</ul>
				</li>
				<li class="has-sub">
					<a href="javascript:;" class="">
					<i class="icon-envelope"></i> Inbox
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li><a class="" href="/inbox">Inbox</a></li>
						<li><a class="" href="/inbox/sent">Poslate</a></li>
						<li><a class="" href="/inbox/removed">Obrisane</a></li>
					</ul>
				</li>
				<li >
					<a href="/forum" class=""><i class="icon-comment"></i> Forum</a>
				</li>
				<li class="has-sub">
					<a href="javascript:;" class="">
					<i class="icon-group"></i> Članovi
					<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li><a class="" href="/members">Lista članova</a></li>
						<li><a class="" href="/members/search">Pretrazi članove</a></li>
					</ul>
				</li>
				<li >
					<a href="/trans" class=""><i class="icon-gift"></i> Transakcije</a>
				</li>
				<li>
					<a href="/kurs" class=""><i class="icon-globe"></i> Kurs</a>
				</li>
				<li>
					<a href="/res" class=""><i class="icon-certificate"></i> Resursi</a>
				</li>
                <li>
                    <a href="/feedback" class=""><i class="icon-right"></i> Feedback</a>
                </li>
			</ul>
		</div>