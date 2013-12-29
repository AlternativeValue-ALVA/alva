<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
include('app/head.php');
$id = $_GET['get'];
$id = str_replace('/','',$id);
if($id == '')
{
	$id = 1;
}
if(!is_numeric($id))
{
 $id = 1;
}
if($id < 0)
{
	$id = 1;
}
?>

		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Forum</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-comment"></i>
					<a href="board">Forum</a> 				
				</li>	
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">Forum</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">
                        <div class="portlet-body">
						<p><a class="btn btn-info" href="novatema">Nova Tema</a></p>
						<?php
$perpage      = 10;
$page         = $id;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pitanja` ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($rows = $qls->SQL->fetch_array($users_result))
{
?>
<div class="mi_box" style="height: 100px;">
<div class="span2">
<a href="/profile/<?php echo $rows['uid']; ?>"><img src="/crc/<?php echo md5($rows['uid']) ?>.jpg" width="64px" height="64px"></a>
<p><span class="label label-warning"><a href="/profile/<?php echo $rows['uid']; ?>"><?php echo $rows['uid']; ?></span></p>
</div>
<div class="span7">
<h2><a href="/topic/<?php echo $rows['id']; ?>"><?php echo substr($rows['naslov'], 0, 20); ?></a> <?php if(($rows['zakljucana'] == 1)) { echo '<span class="label label-important">Zakljucano</span>'; } ?></h2>
<p><?php echo substr($rows['tekst'], 0, 50); ?>...</p>
<p>
</p>
</div>
<p style="float: right;"> <span class="label"><?php echo $rows['datetime']; ?></span> <span class="label label-info"><?php echo $rows['reply']; ?> odgovora</span> <span class="label label-success"><?php echo $rows['view']; ?> pregleda</span></p>
</div>
<?php
}
?>
<a class="btn btn-info" href="/novatema">Nova Tema</a>
                     </div>
                        <div class="space5"></div>
                        <div class="pagination pagination-left">
						<ul><?php
$users     = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}pitanja` ORDER BY `id` DESC");
$num_rows  = $qls->SQL->num_rows($users);
$page      = $id;
$offset    = ($page - 1) * $perpage;
$num_pages = ceil($num_rows / $perpage);

if ($num_pages == 1)
{
	echo '<li><a href="/board/1">1</a></li>';
}
else
{
	$prev_page = $page - 1;
	if ($prev_page > 0)
	{
		$prev_text = '<li><a href="/board/1">PRVA</a></li><li><a href="/board/'.$prev_page.'">PREDHODNA</a></li>';
	}
	else
	{
		$prev_text = '';
	}
	
	echo $prev_text;
	
	$low_num  = $page - 3;
	$high_num = $page + 3;
	if ($low_num < 1)
	{
		$low_num = 1;
	}
	
	if ($high_num > $num_pages)
	{
		$high_num = $num_pages;
	}
	
	for ($x = $low_num; $x < ($high_num + 1); $x++)
	{
		if ($x == $page)
		{
			$bold = true;
		}
		else
		{
			$bold = false;
		}
		
		if ($bold === true)
		{
			echo '<li><a href="/board/'.$x.'" ><i>'.$x.'</i></a></li>';
		}
		else
		{
			echo '<li><a href="/board/'.$x.'" >'.$x.'</a></li>';
		}
	}
	
	$next_page = $page + 1;
	if ($next_page < ($num_pages + 1))
	{
		$next_text = '<li><a href="/board/'.$next_page.'" >IDUCA</a></li><li><a href="/board/'.$num_pages.'" >POSLEDNJA</a></li>';
	}
	else
	{
		$next_text = '';
	}
	
	echo $next_text;
}
?>
                             
								
                
                           </ul>
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
   <script src="/assets/css/excanvas.js"></script>
   <script src="/assets/css/respond.js"></script>  
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
			Search.init(); 
		});
	</script>
</html>