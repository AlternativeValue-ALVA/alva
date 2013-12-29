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
	$id = str_replace('rid','',$id);
	if(!is_numeric($id)){die;}
	$result = $qls->SQL->select('*', 'resursi', array(
		'id' => array(
			'=',
			$id
		)
	));
	$row    = $qls->SQL->fetch_array($result);
?>
<link href="/assets/css/profile.css" rel="stylesheet" />
<div class="page-content">     
<div class="container-fluid">   
<div class="row-fluid">
    <div class="span12">                      
        <h3 class="page-title"><?php echo $row['naslov']; ?></h3>
        <ul class="breadcrumb">
            <li><i class="icon-user"></i><a href="/res">Resursi</a>                                                             <i class="icon-angle-right"></i></li>
            <li><a href="/res/rid<?php echo $id; ?>/"><?php echo $row['naslov']; ?></a></li>
        </ul>               
    </div>
</div>            
<div class="row-fluid profile">
<div class="span12">                  
<div class="tabbable tabbable-full-width">

<div class="tab-content">
<div class="tab-pane row-fluid active" id="tab_1_1">
<div class="span9"><center>
<p><?php echo $row['opis'];?></p>
<p><img src="<?php echo str_replace('../','/',$row['slika']);?>"></p>
<p>Vrednost <?php echo $row['cena']; ?> | <a href="/profile/<?php echo $row['uid']; ?>"><?php echo $row['uid']; ?></a></p>
<p><?php echo $row['datetime']; ?></p>
<p><a href="/report/res/<?php echo $id ?>">Prijavi</a><?php
if ($qls->user_info['auth_admin'] == 1)
{
	if(($row['uid'] != $qls->user_info['username']))
	{
		if(($row['obrisana'] == 1))
		{
			echo ' | <a href="/admin/vratir/'.$id.'">Vrati</a> | <a href="/admin/izmenir/'.$id.'">Izmeni</a>';
		}
		else
		{
			echo ' | <a href="/admin/obrisir/'.$id.'">Obrisi</a> | <a href="/admin/izmenir/'.$id.'">Izmeni</a>';
		}
	}
}
	if(($row['uid'] == $qls->user_info['username']))
	{
		if(($row['obrisana'] == 1))
		{
			echo ' | <a href="/usr/vratir/'.$id.'">Vrati</a> | <a href="/usr/izmenir/'.$id.'">Izmeni</a>';
		}
		else
		{
			echo ' | <a href="/usr/obrisir/'.$id.'">Obrisi</a> | <a href="/usr/izmenir/'.$id.'">Izmeni</a>';
		}
	}
?> resurs</p></center>
    </div>                                                              
</div>                              
                           </div>
                        </div>
                     </div>
                  </div>   
               </div>
            </div>
    <div class="footer">
      2013 <a href="/index">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
}
else
{
?>
		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Resursi</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-certificate"></i>
					<a href="/res">Resursi</a> 				
				</li>	
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">Pretraga Resursa</a></li>
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
									<th>NAZIV</th>
                                    <th>OPIS</th>
                                    <th>CENA</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
							  <?php
$perpage      = 50;
$page         = $id;
$offset       = ($page - 1) * $perpage;
$users_result = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}resursi` WHERE `obrisana` = 0 ORDER BY `id` DESC LIMIT {$offset},{$perpage}");
while ($users_row = $qls->SQL->fetch_array($users_result))
{
?>
	<tr>							
									<td><a href="/res/rid<?php echo $users_row['id']; ?>"><?php echo $users_row['id']; ?></a></td>
                                    <td><a href="/res/rid<?php echo $users_row['id']; ?>"><img height ="60px" width="60px" src="<?php echo str_replace('../','/',$users_row['slika']); ?>" /></a></td>                                    
									<td><a href="/res/rid<?php echo $users_row['id']; ?>"><?php echo $users_row['naslov']; ?></a></td>
                                    <td><?php echo $users_row['opis']; ?></td>
                                    <td><?php echo $users_row['cena']; ?></td>
                                    <td><a class="btn mini red-stripe" href="/profile/<?php echo $users_row['uid']; ?>">Profil</a></td>
                                 </tr>
<?php
}
?>
                                 
                              </tbody>
                           </table>
                        </div>
                        <div class="space5"></div>
                        <div class="pagination pagination-left">
						<ul><?php
$users     = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}resursi` WHERE `obrisana` = 0 ORDER BY `id` DESC");
$num_rows  = $qls->SQL->num_rows($users);
$page      = $id;
$offset    = ($page - 1) * $perpage;
$num_pages = ceil($num_rows / $perpage);

if ($num_pages == 1)
{
	echo '<li><a href="/res/1">1</a></li>';
}
else
{
	$prev_page = $page - 1;
	if ($prev_page > 0)
	{
		$prev_text = '<li><a href="/res/1">PRVA</a></li><li><a href="/res/'.$prev_page.'">PREDHODNA</a></li>';
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
			echo '<li><a href="/res/'.$x.'" ><i>'.$x.'</i></a></li>';
		}
		else
		{
			echo '<li><a href="/res/'.$x.'" >'.$x.'</a></li>';
		}
	}
	
	$next_page = $page + 1;
	if ($next_page < ($num_pages + 1))
	{
		$next_text = '<li><a href="/res/'.$next_page.'" >IDUCA</a></li><li><a href="/res/'.$num_pages.'" >POSLEDNJA</a></li>';
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