<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
include('app/head.php');
$id = $get;
$id = str_replace('/','',$id);
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
	$id = str_replace('tid','',$id);
	$result = $qls->SQL->select('*', 'transakcije', array(
		'id' => array(
			'=',
			$id
		)
	));
	$row    = $qls->SQL->fetch_array($result);
?>


		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Transkacija <?php echo $id; ?></h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-gift"></i>
					<a href="/trans">Transakcije</a> 				
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="/trans/tid<?php echo $id; ?>">Transkacija <?php echo $id; ?></a></li>		
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
				  <center>
<table>
<tr>
<td width="14%"><strong>KO</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $qls->id_to_username($row['idko']); ?></span></td>
</tr>
<tr>
<td width="14%"><strong>KOME</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $qls->id_to_username($row['idkome']); ?></span></td>
</tr>
<tr>
<td width="14%"><strong>KOLICINA</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $row['kolko']; ?></span></td>
</tr>
<tr>
<td width="14%"><strong>RAZLOG</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $row['zasto']; ?></span></td>
</tr>
<tr>
<td width="14%"><strong>ODOBRENA</strong></td>
<td width="2%">:</td>
<td width="84%"><?php
		if ($row['odobrena'] == "1")
		{
			if ($qls->user_info['auth_admin'] == 1)
			{
				echo '<span class="label label-success">Odobrena <a href="/admin/uklonit/'.$row['id'].'">[ne-odobri]</a></span>';
			}
			else
			{
				echo '<span class="label label-success">Odobrena</span>';
			}
		}
		else
		{
			if ($qls->user_info['auth_admin'] == 1)
			{
				echo '<span class="label label-warning"><a href="/admin/odobrit/' . $row['id'] . '">Ne odobrena</a></span>';
			}
			else
			{
				echo '<span class="label label-warning">Ne odobrena</span>';
			}
		}
?>
</td>
</tr>
<tr>
<td width="14%"><strong>VREME</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $row['vreme']; ?></span></td>
</tr><tr>
<td width="14%"><strong>TIP</strong></td>
<td width="2%">:</td>
<td width="84%"><span class="label label-success"><?php echo $row['tip'];?></span></td>
</tr>
</table>
                        </div>
                        <div class="space5"></div>
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
<?php
}
else
{
?>
		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Transakcije</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-gift"></i>
					<a href="trans">Transakcije</a> 				
				</li>
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">Lista Transakcija</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">
                        <div class="portlet-body">
                           <table class="table table-striped table-hover">
                              <thead>
                                 <tr>
									<th>ID</th>
                                    <th>POSILJALAC</th>
                                    <th>PRIMALAC</th>
                                    <th>ALVA</th>
                                    <th>STATUS</th>
                                    <th>TIP</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
							  <?php
	$perpage      = 50;
	$page         = $id;
	$offset       = ($page - 1) * $perpage;
	$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}transakcije` WHERE `odobrena` = 1 ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
	while ($users_row = $qls->SQL->fetch_array($users_result))
	{
?>
									<tr><td><a href="/trans/tid<?php
		echo $users_row['id'];
?>"><?php
		echo $users_row['id'];
?></a></td>
                                    <td><a href="/profile/<?php
		echo $qls->id_to_username($users_row['idko']);
?>"><?php
		echo $qls->id_to_username($users_row['idko']);
?></a></td>                                    
									<td><a href="/profile/<?php
		echo $qls->id_to_username($users_row['idkome']);
?>"><?php
		echo $qls->id_to_username($users_row['idkome']);
?></a></td>
									<td><?php
		echo $users_row['kolko'];
?></td>
									<td><?php
		if ($users_row['odobrena'] == "1")
		{
			echo '<span class="label label-success">Odobrena</span>';
		}
		else
		{
			if ($qls->user_info['auth_admin'] == 1)
			{
				echo '<span class="label label-warning"><a href="/admin/odobrit/' . $users_row['id'] . '">Ne odobrena</a></span>';
			}
			else
			{
				echo '<span class="label label-warning">Ne odobrena</span>';
			}
		}
?></td>
									<td><?php
		echo $users_row['tip'];
?></td>
                                    <td><a class="btn mini red-stripe" href="/trans/tid<?php
		echo stripslashes($users_row['id']);
?>">Detaljnije</a></td>
                                 </tr>
<?php
	}
?>
                                 
                              </tbody>
                           </table>
                        </div>
                        <div class="space5"></div>
                        <div class="pagination">
						<ul><?php
$users     = $qls->SQL->query("SELECT id FROM `{$qls->config['sql_prefix']}transakcije` WHERE `odobrena` = 1 ORDER BY `id` DESC");
$num_rows  = $qls->SQL->num_rows($users);
$page      = $id;
$offset    = ($page - 1) * $perpage;
$num_pages = ceil($num_rows / $perpage);

if ($num_pages == 1)
{
	echo '<li><a href="/trans/1">1</a></li>';
}
else
{
	$prev_page = $page - 1;
	if ($prev_page > 0)
	{
		$prev_text = '<li><a href="/trans/1">PRVA</a></li><li><a href="/trans/'.$prev_page.'">PREDHODNA</a></li>';
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
			echo '<li><a href="/trans/'.$x.'" ><i>'.$x.'</i></a></li>';
		}
		else
		{
			echo '<li><a href="/trans/'.$x.'" >'.$x.'</a></li>';
		}
	}
	
	$next_page = $page + 1;
	if ($next_page < ($num_pages + 1))
	{
		$next_text = '<li><a href="/trans/'.$next_page.'" >IDUCA</a></li><li><a href="/trans/'.$num_pages.'" >POSLEDNJA</a></li>';
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
      2013 <a href="home">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
			 if (jQuery().datepicker) {
                $('.date-picker').datepicker();
            }

            App.initFancybox();
		});
	</script>
</html>
<?php
}
?>