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
			<h3 class="page-title">Clanovi</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-group"></i>
					<a href="members">Clanovi</a> 				
				</li>	
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">Pretraga Korisnika</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">

                        <div class="row-fluid search-forms search-default">
                           <form class="form-search" action="#">
                              <div class="chat-form">
                                 <div class="input-cont">   
                                    <input type="text" placeholder="Pretraga..." class="m-wrap" />
                                 </div>
                                 <button type="button" class="btn green">Pretraga &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                              </div>
                           </form>
                        </div>
                        <div class="portlet-body">
                           <table class="table table-striped table-hover">
                              <thead>
                                 <tr>
									<th>ID</th>
                                    <th>SLIKA</th>
                                    <th>KORISNICKO IME</th>
                                    <th>IME</th>
                                    <th>ALVA</th>
                                    <th>STATUS</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
							  <?php
$perpage      = 10;
$page         = $id;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}users` ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($users_row = $qls->SQL->fetch_array($users_result))
{
?>
	<tr>							
	<td><?php
	echo $users_row['id'];
?></td>
                                    <td><img src="/crc/<?php
	echo md5($users_row['username']);
?>_s.jpg" alt="" /></td>                                    
									<td><a href="/profile/<?php
	echo stripslashes($users_row['username']);
?>"><?php
	echo stripslashes($users_row['username']);
?></td>
                                    <td class="hidden-phone"><?php
	echo $users_row['firstname'];
?></td>
                                    <td class="hidden-phone"><?php
	echo $users_row['alve'];
?></td>
                                    <td><?php
	if ($users_row['active'] == "yes")
	{
		echo '<span class="label label-success">Odobren';
	}
	else
	{
		if ($qls->user_info['auth_admin'] == 1)
		{
			echo '<span class="label label-warning"><a href="/admin/odobrik/'.$users_row['id'].'">Ne odobren</a>';
		}
		else
		{
			echo '<span class="label label-warning">Ne odobren';
		}
	}
?></span></td>
                                    <td><a class="btn mini red-stripe" href="/profile/<?php
	echo stripslashes($users_row['username']);
?>">Profil</a></td>
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
$users     = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}users` ORDER BY `id` DESC");
$num_rows  = $qls->SQL->num_rows($users);
$page      = $id;
$offset    = ($page - 1) * $perpage;
$num_pages = ceil($num_rows / $perpage);

if ($num_pages == 1)
{
	echo '<li><a href="/members/1">1</a></li>';
}
else
{
	$prev_page = $page - 1;
	if ($prev_page > 0)
	{
		$prev_text = '<li><a href="/members/1">PRVA</a></li><li><a href="/members/'.$prev_page.'">PREDHODNA</a></li>';
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
			echo '<li><a href="/members/'.$x.'" ><i>'.$x.'</i></a></li>';
		}
		else
		{
			echo '<li><a href="/members/'.$x.'" >'.$x.'</a></li>';
		}
	}
	
	$next_page = $page + 1;
	if ($next_page < ($num_pages + 1))
	{
		$next_text = '<li><a href="/members/'.$next_page.'" >IDUCA</a></li><li><a href="/members/'.$num_pages.'" >POSLEDNJA</a></li>';
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