<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
include('app/head.php');
$get  = $_GET['get'];
$get  = preg_replace("/[^a-zA-Z0-9]+/", "", $get);
$get2 = $_GET['get2'];
$get2 = preg_replace("/[^a-zA-Z0-9]+/", "", $get2);
$user = $qls->user_info['username'];
if (($get == "sent"))
{
?>
      <div class="page-content" data-height="967" style="min-height: 978px;">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">		
			<h3 class="page-title">Poslate Poruke</h3></div>
            </div>
            <div class="row-fluid inbox">
               <div class="span2">
                  <ul class="inbox-nav margin-bottom-10">
                     <li class="compose-btn">
                        <a href="/novaporuka" data-title="Nova Poruka" class="btn green"> 
                        <i class="icon-edit"></i> Nova Poruka
                        </a>
                     </li>
                     <li class="inbox"><a href="/inbox" class="btn" data-title="Inbox">Inbox</a></li>
                     <li class="inbox active"><a class="btn" href="/inbox/sent" data-title="Poslate">Poslate</a><b></b></li>
                     <li class="inbox"><a class="btn" href="/inbox/junk" data-title="Obrisane">Obrisane</a><b></b></li>
                  </ul>
               </div>
               <div class="span10">
                  <div class="inbox-content"><table class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th colspan="3">
				<div class="checker" id="uniform-undefined"><span><input type="checkbox" class="mail-checkbox mail-group-checkbox" style="opacity: 0;"></span></div>
				<div class="btn-group">
					<a class="btn mini blue" href="#" data-toggle="dropdown">
					Vise
					<i class="icon-angle-down "></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-trash"></i> Obrisi</a></li>						
					</ul>
				</div>
			</th>
			<th class="text-right" colspan="3">
				<ul class="unstyled inline inbox-nav">
					<li></li>
					<li><i class="icon-angle-left  pagination-left"></i></li>
					<li><i class="icon-angle-right pagination-right"></i></li>
				</ul>
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$perpage      = 10;
$page         = 1;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pm`WHERE (ko = '$user') ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($rows = $qls->SQL->fetch_array($users_result))
{
?>
		<tr class="unread">
			<td class="inbox-small-cells">
				<div class="checker" id="uniform-undefined"><span><input type="checkbox" class="mail-checkbox" style="opacity: 0;"></span></div>
			</td>
			<td class="inbox-small-cells"><i class="icon-star"></i></td>
			<td class="view-message  hidden-phone"><?php echo $rows['kome']; ?></td>
			<td class="view-message "><a href="/poruka/<?php echo $rows['id']; ?>"><?php echo substr($rows['tekst'], 0, 40); ?></a></td>
			<td class="view-message  inbox-small-cells"></td>
			<td class="view-message  text-right"><?php echo $rows['datetime']; ?></td>
		</tr>
<?php
}
?>
	</tbody>
</table></div>
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
			App.init();
		});
	</script>
</html>
<?php
die;
}
if (($get == "junk"))
{
?>
      <div class="page-content" data-height="967" style="min-height: 978px;">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">		
			<h3 class="page-title">Junk</h3></div>
            </div>
            <div class="row-fluid inbox">
               <div class="span2">
                  <ul class="inbox-nav margin-bottom-10">
                     <li class="compose-btn">
                        <a href="/novaporuka" data-title="Nova Poruka" class="btn green"> 
                        <i class="icon-edit"></i> Nova Poruka
                        </a>
                     </li>
                     <li class="inbox"><a href="/inbox" class="btn" data-title="Inbox">Inbox</a></li>
                     <li class="inbox"><a class="btn" href="/inbox/sent" data-title="Poslate">Poslate</a><b></b></li>
                     <li class="inbox active"><a class="btn" href="/inbox/junk" data-title="Obrisane">Obrisane</a><b></b></li>
                  </ul>
               </div>
               <div class="span10">
                  <div class="inbox-content"><table class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th colspan="3">
				<div class="checker" id="uniform-undefined"><span><input type="checkbox" class="mail-checkbox mail-group-checkbox" style="opacity: 0;"></span></div>
				<div class="btn-group">
					<a class="btn mini blue" href="#" data-toggle="dropdown">
					Vise
					<i class="icon-angle-down "></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-trash"></i> Vrati Iz Junk-a</a></li>						
					</ul>
				</div>
			</th>
			<th class="text-right" colspan="3">
				<ul class="unstyled inline inbox-nav">
					<li></li>
					<li><i class="icon-angle-left  pagination-left"></i></li>
					<li><i class="icon-angle-right pagination-right"></i></li>
				</ul>
			</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table></div>
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
			App.init();
		});
	</script>
</html>
<?php
die;
}
?>
      <div class="page-content" data-height="967" style="min-height: 978px;">
	   <div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">  
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Inbox <small>Tvoj inbox</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
							<a href="/inbox">Inbox</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
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
							<h1 class="pull-left">Inbox</h1>
						</div>
						<div class="inbox-loading" style="display: none;">Ucitavanje...</div>
						<div class="inbox-content"><table class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th colspan="3">
				<div class="checker"><span><input type="checkbox" class="mail-checkbox mail-group-checkbox"></span></div>
				<div class="btn-group">
					<a class="btn mini blue" href="#" data-toggle="dropdown">
					Vise
					<i class="icon-angle-down "></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-pencil"></i> Oznaci kao prictano</a></li>
						<li><a href="#"><i class="icon-ban-circle"></i> Spam</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-trash"></i> Obrisi</a></li>
					</ul>
				</div>
			</th>
			<th class="text-right" colspan="3">
				<ul class="unstyled inline inbox-nav">
					<li><span>1-10 od 10</span></li>
					<!--<li><i><  </i></li>
					<li><i class="icon-angle-right pagination-right" onclick="window.location.href='page2.php'">></i></li> !-->
				</ul>
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
$perpage      = 10;
$page         = 1;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pm`WHERE (kome = '$user' AND obrisana = '0' )ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($rows = $qls->SQL->fetch_array($users_result))
{
?>
		<tr class="unread">
			<td class="inbox-small-cells">
				<div class="checker"><span><input type="checkbox" class="mail-checkbox"></span></div>
			</td>
			<td class="inbox-small-cells"><i class="icon-star"></i></td>
			<td class="view-message  hidden-phone"><a href="profile/<?php echo $rows['ko']; ?>"><img src="/crc/<?php echo md5($rows['ko']); ?>_s.jpg"> <?php echo $rows['ko']; ?></a></td>
			<td class="view-message "><a href="poruka/<?php echo $rows['id']; ?>"><?php echo $rows['naslov']; ?></td>
			<td class="view-message  inbox-small-cells"><i class="icon-paper-clip"></i></td>
			<td class="view-message  text-right"><?php echo $rows['datetime']; ?></td>
		</tr>
		<?php
}
?>
	</tbody>
</table>
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
			App.init();
		});
	</script>
</html>