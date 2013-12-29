<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
?>
<link href="/assets/css/profile.css" rel="stylesheet" />
<link href="/assets/js/bootstrap-fileupload.css" rel="stylesheet" />
<div class="page-content">     
<div class="container-fluid">   
<div class="row-fluid">
    <div class="span12">                      
        <h3 class="page-title"><?php
echo $row['firstname'];
?> <?php
echo $row['lastname'];
?></h3>
        <ul class="breadcrumb">
            <li><i class="icon-user"></i><a href="/members">Clanovi</a>                                                             <i class="icon-angle-right"></i></li>
            <li><a href="/profile/<?php
echo $row['username'];
?>"><?php
echo $row['username'];
?></a></li>
        </ul>               
    </div>
</div>            
<div class="row-fluid profile">
<div class="span12">                  
<div class="tabbable tabbable-custom tabbable-full-width">
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1_1" data-toggle="tab">Pregled</a></li>
    <li><a href="#tab_1_2" data-toggle="tab">Informacije</a></li>
    <li><a href="#tab_1_4" data-toggle="tab">Resursi</a></li>
	<li><a href="#tab_1_5" data-toggle="tab">Komentari</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane row-fluid active" id="tab_1_1">
<ul class="unstyled profile-nav span3">
    <img src="/crc/<?php
echo md5($row['username']);
?>.jpg" alt="" />
    <li><a href="/novaporuka/<?php echo $row['username']; ?>">Poruke</a></li>
    <li><a href="#">Prijatelji</a></li>
</ul>
<div class="span9">
<div class="row-fluid">
    <div class="span8 profile-info">
        <h1><?php
echo stripslashes($row['firstname']);
?> <?php
echo stripslashes($row['lastname']);
?></h1>
        <p><?php
echo stripslashes($row['about']);
?></p>
        <p><a href="#"></a></p>
        <ul class="unstyled inline">
<?php if($row['country'] != '') { ?><p><li><i class="icon-map-marker"></i> <?php echo $row['country']; ?> ,<?php if($row['gradh'] == '0'){ echo $row['city']; }?></li></p><?php } ?>
<?php if($row['ulicah'] == '0'){ if($row['street'] != '') { ?><p><li><i class="icon-road"></i> <?php echo $row['street']; ?></li></p><?php }} ?>
<?php if($row['godineh'] == '0'){ if($row['years'] != '') { ?><p><li><i class="icon-calendar"></i> <?php echo $row['years']; ?></li></p><?php }} ?>
<?php if($row['telefonh'] == '0'){ if($row['phone'] != '') { ?><p><li><i class="icon-mobile-phone">  </i> <?php echo $row['phone']; ?></li></p><?php }} ?>
<?php if ($row['verifikovan'] == 1) echo '<p><li><i class="icon-star"></i> Verifikovan Clan</li></p>'; ?></ul>                       
    </div>                                 
    <div class="span4">
        <div class="portlet sale-summary">
            <div class="portlet-title">
                <div class="caption">Alva Statistiku</div>
            </div>
            <ul class="unstyled">
                <li><span class="sale-info">POSLATO    <i class="icon-img-up"></i></span>                                              <span class="sale-num"><?php
echo stripslashes($row['poslate']);
?></span>                                          </li>
                <li><span class="sale-info">PRIMLJENO <i class="icon-img-down"></i></span>                                              <span class="sale-num"><?php
echo stripslashes($row['primljene']);
?></span>                                          </li>
                <li><span class="sale-info">ALVA</span> <span class="sale-num"><?php
echo stripslashes($row['alve']);
?></span>                                          </li>
            </ul>
        </div>
    </div>                              
</div>                              
<div class="tabbable tabbable-custom tabbable-custom-profile">
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1_11" data-toggle="tab">Poslednje Transakcije</a></li>
    <li class=""><a href="#tab_1_23" data-toggle="tab">Posalji Alvu</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1_11">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th><i class="icon-briefcase"></i> Osoba</th>
                    <th><i class="icon-bookmark"></i> Kolicina</th>
                    <th class="hidden-phone"><i class="icon-question-sign"></i> Opis</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
$idd         = $row['id'];
$transakcije = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}transakcije` WHERE (idko = '$idd' OR idkome = '$idd') AND `odobrena` = 1 ORDER BY id DESC");
while ($users_row = $qls->SQL->fetch_array($transakcije))
{
?>
   <tr>
    <?php
	if ($users_row['idkome'] == $idd)
	{
?>
           <td><a href="/profile/<?php
		echo stripslashes($qls->id_to_username($users_row['idko']));
?>"><?php
		echo stripslashes($qls->id_to_username($users_row['idko']));
?></a></td>
            <?php
	}
	else
	{
?>
   
<td><a href="/profile/<?php
		echo stripslashes($qls->id_to_username($users_row['idkome']));
?>"><?php
		echo stripslashes($qls->id_to_username($users_row['idkome']));
?></a></td>
            <?php
	}
?>
   <td><?php
	if ($users_row['idkome'] == $idd)
	{
?>
       <span class="label label-success label-mini">Primljeno</span><?php
	}
	else
	{
?><span class="label label-important label-mini">Poslato</span><?php
	}
?><?php
	echo $users_row['kolko'];
?></td>
    <td class="hidden-phone"><?php
	echo $users_row['zasto'];
?></td>
    <td><a class="btn mini blue-stripe" href="/trans/tid<?php
	echo $users_row['id'];
?>">Detaljnije</a></td>
   </tr>
<?php
}
?>
				<tr>
                    <td><a href="http://alva.rs">ALVA</a></td>
					<td><span class="label label-success label-mini">Primljeno</span>500 </td>
                    <td class="hidden-phone">Rodjenje</td>
                    <td><a class="btn mini blue-stripe" href="/trans/tid0">Detaljnije</a></td>
                </tr>
			</tbody>
		</table>
	</div>
<div class="tab-pane" id="tab_1_23">
<div class="tab-pane active" id="tab_1_1_1">
<div data-height="100px" data-always-visible="1" data-rail-visible1="0">
<center>Upisite koliko alve zelite da posaljete ovoj osobi ?</center>
<br><center><form id="frm1" action="/transferx" method="post" /><br><input type="hidden" name="user" value="<?php
echo $_GET['get'];
?>" /><br><input class="m-wrap" name="razlog" maxlength="250" type="text" placeholder="Razlog" /><br><input class="m-wrap" name="alve" maxlength="6" type="text" placeholder="100" /> <br><center><input type="submit" value="PO&#352;ALJI" id="login-btn" class="btn green"></center></form></center>
</div>
</div>
</div>
                                    
                                 </div>
                              </div>
                           </div>
                           
                        </div>
                        
						<div class="tab-pane profile-classic row-fluid" id="tab_1_2">
                           <div class="span2"><img src="/crc/<?php
echo md5($row['username']);
?>.jpg" alt="" /></div>
                           <ul class="unstyled span10">
                              <li><span>Korisnicko Ime:</span> <?php
echo $row['username'];
?></li>
                              <li><span>Ime:</span> <?php
echo $row['firstname'];
?></li>
                              <li><span>Prezime:</span> <?php
echo $row['lastname'];
?></li>
                              <li><span>Drzava:</span> <?php
echo $row['country'];
?></li>
                              <li><span>Godiste:</span> <?php
echo $row['years'];
?></li>
                              <li><span>Email:</span> <a href="#"><?php
echo $row['email'];
?></a></li>
                              <li><span>Telefon:</span> <?php
echo $row['phone'];
?></li>
                              <li><span>O Sebi:</span> <?php
echo $row['about'];
?></li>
                           </ul>
                        </div>
						         <div class="tab-pane" id="tab_1_4">
                           <div class="row-fluid add-portfolio">
                              <div class="pull-left">
                                 <span>Resursi</span>
                              </div>
                           </div>
						   <?php
$idx   = $row['username'];
$trans = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}resursi` WHERE uid = '$idx' AND `obrisana` = 0 ORDER BY id DESC");
while ($users_row = $qls->SQL->fetch_array($trans)) {
?>
<div class="row-fluid portfolio-block">
                              <div class="span5 portfolio-text">
                                 <img width="90" height="90" src="<?php echo str_replace('../','/',$users_row['slika']);?>" alt="" />
                                 <div class="portfolio-text-info">
                                    <h4><?php
	echo $users_row['naslov'];
?></h4>
                                    <p><?php
	echo $users_row['opis'];
?></p>
                                 </div>
                              </div>
                              <div class="span5" style="overflow:hidden;">
                                 <div class="portfolio-info">
                                    ALVE
                                    <span><?php
	echo $users_row['cena'];
?></span>
                                 </div>
                              </div>
                              <div class="span2 portfolio-btn">
                                 <a href="/res/rid<?php echo $users_row['id']; ?>" class="btn bigicn-only"><span>Pogledaj</span></a>                      
                              </div>
                           </div>
<?php
}
?> 
                        </div>
	<!---------------------- KOMENTARI ----------------------------------->
						<div class="tab-pane" id="tab_1_5">
                           <div class="row-fluid add-portfolio">
                              <div class="pull-left">
                                 <span>Moj Guestbook</span>
                              </div>
                           </div>
						   <div id="kontener">
	<div class="timeline_kontener">
		<div class="timeline">
			<div class="plus"></div>
		</div>
	</div>
						   <?php
$trans = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}komentari` WHERE uid = '$idx' AND `obrisana` = 0 ORDER BY id DESC");
while ($users_row = $qls->SQL->fetch_array($trans)) {
?>
<div class="item ">
		<a href='#' class='deletebox'>X</a>
		<div><?php echo $users_row['tekst']; ?><br>By <a href="/profil/<?php echo $users_row['ko']; ?>"><?php echo $users_row['ko']; ?></a> <?php echo $users_row['date']; ?></div>
</div>
<?php
}
?> 
</div>
                        </div>
						
		<!------------------------ KOMENTARI END -------------------------->
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