<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;	
}
require('app/head.php');
?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">		
						<h3 class="page-title">Home</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="/home">Home</a> 
							</li>
							<li class="pull-right no-text-shadow">
								<div id="dashboard-report-range" class="dashboard-date-range responsive" style="display: block;">
									<i class="icon-calendar"></i>
									<span><?php echo date("Y/m/d"); ?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="dashboard">
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat blue">
								<div class="visual">
									<i class="icon-comments"></i>
								</div>
								<div class="details">
									<div class="number">
										<?php
$result = mysql_query("SELECT max(id) FROM qls3_pitanja");
if (!$result)
{
	die('Could not query:' . mysql_error());
}
$id = mysql_result($result, 0);
echo $id;
?>
									</div>
									<div class="desc">									
										NOVIH FORUM TEMA
									</div>
								</div>
								<a class="more" href="/board">
								Pogledaj vise <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat green">
								<div class="visual">
									<i class="icon-shopping-cart"></i>
								</div>
								<div class="details">
									<div class="number"><?php $result = mysql_query("SELECT max(id) FROM qls3_transakcije");
if (!$result) {
    die('Could not query:' . mysql_error());
}
$id = mysql_result($result, 0);
echo $id;?></div>
									<div class="desc">TRANSAKCIJA</div>
								</div>
								<a class="more" href="/trans">
								Pogledaj vise <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
							<div class="dashboard-stat purple">
								<div class="visual">
									<i class="icon-globe"></i>
								</div>
								<div class="details">
									<div class="number"><?php $result = mysql_query("SELECT max(id) FROM qls3_users");
if (!$result) {
    die('Could not query:' . mysql_error());
}
$id = mysql_result($result, 0);
echo $id;?></div>
									<div class="desc">CLANOVI</div>
								</div>
								<a class="more" href="/members">
								Pogledaj vise <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat yellow">
								<div class="visual">
									<i class="icon-bar-chart"></i>
								</div>
								<div class="details">
									<div class="number"><?php 
									$x = '25000'; //hiljada dinara
									$k =  '0.00004';//koficijent za valutu  
									$y = sqrt($k * $x);
									echo $y = number_format($y, 4, '.', '');?>RSD</div>
									<div class="desc">ALVA/RSD</div>
								</div>
								<a class="more" href="/kurs">
								Pogledaj vise <i class="m-icon-swapright m-icon-white"></i>
								</a>						
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="span6">
							<div class="portlet solid bordered light-grey">
								<div class="portlet-title">
									<h4><i class="icon-bar-chart"></i>Posete</h4>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="javascript:;" class="btn mini">Clanovi</a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="site_statistics_loading">
										<img src="/assets/img/loading.gif" alt="Ucitavanje" />
									</div>
									<div id="site_statistics_content" class="hide">
										<div id="site_statistics" class="chart"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="portlet solid light-grey bordered">
								<div class="portlet-title">
									<h4><i class="icon-bullhorn"></i>Aktivnosti</h4>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="javascript:;" class="btn blue mini active">Korisnici</a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="site_activities_loading">
										<img src="/assets/img/loading.gif" alt="Ucitavanje" />
									</div>
									<div id="site_activities_content" class="hide">
										<div id="site_activities" style="height:100px;"></div>
									</div>
								</div>
							</div>
							<div class="portlet solid bordered light-grey">
								<div class="portlet-title">
									<h4><i class="icon-signal"></i>Server Load</h4>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="javascript:;" class="btn red mini active">
											<span class="hidden-phone">Database</span>
											<span class="visible-phone">DB</span></a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="load_statistics_loading">
										<img src="/assets/img/loading.gif" alt="Ucitavanje" />
									</div>
									<div id="load_statistics_content" class="hide">
										<div id="load_statistics" style="height:108px;"></div>
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
      2013 <a href="/home">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
   <div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<script src="/assets/js/jquery-1.8.3.min.js"></script>	
	<!--[if lt IE 9]>
	<script src="/assets/js/excanvas.js"></script>
	<script src="/assets/js/respond.js"></script>	
	<![endif]-->	
	<script src="/assets/breakpoints/breakpoints.js"></script>		
	<script src="/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
	<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.blockui.js"></script>	
	<script src="/assets/js/jquery.cookie.js"></script>
	<script src="/assets/flot/jquery.flot.js"></script>
	<script src="/assets/flot/jquery.flot.resize.js"></script>
	<script type="text/javascript" src="/assets/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="/assets/uniform/jquery.uniform.min.js"></script>	
	<script type="text/javascript" src="/assets/js/jquery.pulsate.min.js"></script>
	<script src="/assets/js/app.js"></script>				
	<script>
		jQuery(document).ready(function() {		
			App.setPage("index");
			App.init();
		});
	</script>
</body>
</html>