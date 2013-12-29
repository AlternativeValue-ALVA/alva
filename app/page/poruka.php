<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;	
}
if ($qls->user_info['username'] == '')
{
	header('Location: ' . $site . '/login');
}
$usr = $qls->user_info['username'];
$sql5="update qls3_pm set procitana='1' WHERE id='$get'";
$result5=mysql_query($sql5);
$id = $get;
$id = str_replace('/','',$id);
$user = $qls->user_info['username'];
?>
<!DOCTYPE html>
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
						</ul>
					</li>
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope-alt"></i>
						<span class="badge"><?php
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
					<a href="/board" class=""><i class="icon-comment"></i> Forum</a>
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
		<?php
if($id == '')
{
	$id = 1;
}
if($id < 0)
{
	$id = 1;
}
if(!is_numeric($id))
{
echo "id nije numericki :D";
die;
}
	$result = $qls->SQL->select('*', 'pm', array(
		'id' => array(
			'=',
			$id
		)
	));
	$row    = $qls->SQL->fetch_array($result);
	if(($row['kome'] != $user))
	{
		if(($row['ko'] != $user))
		{
			echo "neucestvujete u ovoj konverzaciji :)";
			
			die;
		}
	
	}
?>
<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Poruka <?php echo $id; ?></h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-gift"></i>
					<a href="/inbox">Inbox</a> 				
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="/poruka/<?php echo $id; ?>">Poruka <?php echo $id; ?></a></li>		
			</ul>
               </div>
            </div>
			<div class="row-fluid inbox">
					               <div class="span2">
                  <ul class="inbox-nav margin-bottom-10">
                     <li class="compose-btn">
                        <a href="/novaporuka" data-title="Nova Poruka" class="btn green"> 
                        <i class="icon-edit"></i> Nova Poruka
                        </a>
                     </li>
                     <li class="inbox active"><a href="/inbox" class="btn" data-title="Inbox">Inbox</a></li>
                     <li class="inbox"><a class="btn" href="/inbox/sent" data-title="Poslate">Poslate</a><b></b></li>
                     <li class="inbox"><a class="btn" href="/inbox/junk" data-title="Obrisane">Obrisane</a><b></b></li>
                  </ul>
               </div>
					<div class="span10">
						<div class="inbox-header">
							<h1 class="pull-left">Pogledaj Poruku</h1>
						</div>
						<div class="inbox-loading" style="display: none;">Ucitavanje...</div>
						<div class="inbox-content"><div class="inbox-header inbox-view-header">
	<h1 class="pull-left"><?php echo $row['naslov']; ?> <a>Inbox</a></h1>
	<div class="pull-right"><!--<i class="icon-print"></i>!--></div>
</div>
<div class="inbox-view-info row-fluid">
	<div class="span7">
		<img src="/crc/<?php echo md5($row['ko']); ?>_s.jpg">
		<span class="bold"><a href="/profil/<?php echo $row['ko']; ?>"><?php echo $row['ko']; ?></a></span>
		za <span class="bold"><a href="/profil"><?php echo $row['kome']; ?></a></span> u <?php echo $row['datetime']; ?>
	</div>
	<div class="span5 inbox-info-btn">
		<div class="btn-group">
			<?php if($row['kome'] == $user) { ?><a href="/usr/obrisipm/<?php echo $id; ?>"><button class="btn red reply-btn">
			<i class="icon-trash"></i> Obrisi poruku
			</button></a>
			<a href="/novaporuka/<?php echo $row['ko']; ?>/<?php echo $id; ?>"><button class="btn blue reply-btn">
			<i class="icon-reply"></i> Odgovori na poruku
			</button></a>
			<?php }?>
			<!--
			<button class="btn blue  dropdown-toggle" data-toggle="dropdown">
			<i class="icon-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right">
			<li><a href="#"><i class="icon-reply reply-btn"></i> Reply</a></li>
			<li><a href="#"><i class="icon-arrow-right reply-btn"></i> Forward</a></li>
			<li><a href="#"><i class="icon-print"></i> Print</a></li>
			<li class="divider"></li>
			<li><a href="#"><i class="icon-ban-circle"></i> Spam</a></li>
			<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
			<li>
		</li></ul>!--></div>
	</div>
</div>
<div class="inbox-view">
<p><?php echo $row['tekst']; ?></p>
</div>
<hr>
</div>
					</div>
				</div>
      
                  </div>
               </div>      
            </div>
         </div>
      </div>
   </div>
      <div class="footer">
      2013 <a href="index">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-angle-up"></i></span>
      </div>
   </div>
   <script src="/assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>     
   <script src="/assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>      
   <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <!--[if lt IE 9]>
   <script src="/assets/js/excanvas.js"></script>
   <script src="/assets/js/respond.js"></script>  
   <![endif]-->   
   <script src="/assets/fancybox/source/jquery.fancybox.pack.js"></script>
   <script src="/assets/breakpoints/breakpoints.js" type="text/javascript"></script>  
   <script src="/assets/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="/assets/js/jquery.blockui.js" type="text/javascript"></script>  
   <script src="/assets/js/jquery.cookie.js" type="text/javascript"></script>
   <script src="/assets/uniform/jquery.uniform.min.js" type="text/javascript" ></script> 
   <script type="text/javascript" src="/assets/js/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script src="/assets/js/app.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.init(); // init the rest of plugins and elements
			Search.init(); // init the rest of plugins and elements
		});
	</script>
</html>