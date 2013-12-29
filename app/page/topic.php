<?php
include('app/head.php');
// get value of id that sent from address bar 
$id= $get;
$sql="SELECT * FROM qls3_pitanja WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
?>
		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Topic </h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-comment"></i>
					<a href="board">Forum</a> 				
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="/topic/<?php echo $id; ?>"><?php echo $rows['naslov']; ?></a></li>		
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2"><?php echo $rows['naslov']; ?></a><?php if(($rows['zakljucana'] == 1)) { echo '<span class="label label-important">Zakljucano</span>'; } ?></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">
                        <div class="portlet-body">

<div class="mi_box">
<div class="span1">
<p><a href="/profile/<?php echo $rows['uid'];?>"><img width="48px" height="48px" src="/crc/<?php echo md5($rows['uid']) ?>.jpg"></a></p>
<p><span class="label label-warning"><a href="/profile/<?php echo $rows['uid'];?>"><?php echo $rows['uid']; ?></a></span></p>
</div>
<div class="span11">
<h3><?php echo $rows['tekst']; ?></h3>
<p style="float: right;"><a  href="/topic/<?php echo $rows['id'];?>/like/">Like</a> <span >| <a  href="/topic/<?php echo $rows['id'];?>/flag/">Prijavi</a> <span class="label label-info"><?php echo $rows['datetime']; ?></span></p>
</div>
</div>
<br>
<br>
<?php
$sql2="SELECT * FROM qls3_odgovori WHERE pitanje_id='$id'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){
?>
<div class="mi_box">
<div class="span1">
<p><a href="/profile/<?php echo $rows['o_uid'];?>"><img width="48px" height="48px" src="/crc/<?php echo md5($rows['o_uid']) ?>.jpg"></a></p>
<p><span class="label label-warning"><a href="/profile/<?php echo $rows['o_uid'];?>"><?php echo $rows['o_uid']; ?></a></span></p>
</div>
<div class="span11">
<h3><?php echo $rows['o_odgovor']; ?></h3>
<p style="float: right;"><a  href="/topic/<? echo $id;?>/<?php echo $rows['o_id'];?>/like">Like</a> <span >| <a  href="/topic/<? echo $id;?>/<?php echo $rows['o_id'];?>/share>">Share</a> <span >| <a  href="/topic/<? echo $id;?>/<?php echo $rows['o_id'];?>/flag">Report</a> <span class="label label-info"><?php echo $rows['o_datetime']; ?></span></p>
</div>
</div>
<?php
}

$sql3="SELECT view FROM qls3_pitanja WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];
$status = $rows['zakljucana'];
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO qls3_pitanja(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update qls3_pitanja set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
if ($qls->user_info['auth_admin'] == 1)
{
	if(($status == 0)) 
	{
		echo '<span class="label label-warning"><a href="/admin/lockp/'.$id.'">ZAKLJUCAJ TOPIC</a> | <a href="/admin/obrisip/'.$id.'">OBRISI TOPIC</a></span>';
	}
	else
	{
		echo '<span class="label label-warning"><a href="/admin/unlockp/'.$id.'">OTKLJUCAJ TOPIC</a> | <a href="/admin/obrisip/'.$id.'">OBRISI TOPIC</a></span>';
	}
}
if(($status == 0)) {?>
<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="/app/odg_process.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td align="top"><strong>Odgovor</strong></td>
<td align="top">:</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"><textarea name="o_odgovor" cols="45" rows="3" id="o_odgovor"></textarea></td>
<td><input type="submit" class="btn red" name="Submit" value="Odgovori"></td>
</tr>
</table>
</td>
</form>
</tr>
</table> 
<?
} 
?>
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
	<script src="/assets/js/search.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.init(); // init the rest of plugins and elements
			Search.init(); // init the rest of plugins and elements
		});
	</script>
</html>