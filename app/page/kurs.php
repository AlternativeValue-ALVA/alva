<?php
include('app/head.php');
$json = file_get_contents('app/data.json');
$ex = json_decode($json);
?>
		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Kurs</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-globe"></i>
					<a href="/kurs">Kurs</a> 				
				</li>	
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">KURSNA LISTA</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">
                        <div class="portlet-body">
                           <table class="table table-striped table-hover">
                              <thead>
                                 <tr>
									<th>VALUTA</th>
                                    <th>VALUTA/ALVA</th>
                                    <th>ALVA/VALUTA</th>
                                    <th>VALUTA</th>
                                 </tr>
                              </thead>
                              <tbody>
	<tr>							
	<td>RSD</td>
	<td><?php
$rsd = $ex->rates->RSD;
$x = '25'; //hiljada dinara
$k = '0.04';//koficijent za valutu  
$y = sqrt($k * $x);
$y = number_format($y, 4, '.', '');
echo $y;
?></td>
	<td><?php echo number_format(1 / $y,4,'.',''); ?></td>
	<td>Serbian Dinar</td>
	</tr>	
	
	<tr>							
	<td>EUR</td>
	<td><?php
$eur = $ex->rates->EUR;
echo number_format($y * $rsd / $eur, 4, '.', '');
?></td>
	<td><?php echo number_format(1 / number_format($y * $rsd / $eur, 4, '.', ''),4, '.','');?></td>
	<td>Euro</td>
	</tr>
    <tr>							
	<td>USD</td>
	<td>
<?php
echo number_format($y * $rsd, 4, '.', '');
?></td>
	<td><?php echo number_format(1 / number_format($y * $rsd, 4, '.', ''),4, '.', ''); ?></td>
	<td>United States Dollar</td>
	</tr>
	<tr>							
	<td>BTC</td>
	<td><?php
$btc = $ex->rates->BTC;
echo number_format($y * $rsd / $btc, 4, '.', '');
?></td>
	<td><?php echo number_format(1 / number_format($y * $rsd / $btc, 4, '.', ''),4, '.','');?></td>
	<td>Bitcoin</td>
	</tr>
	</tbody>
                           </table>
                        </div>
                        <div class="space5"></div>
                        <div class="pagination pagination-left">
						<ul>                            
								
                
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
      2013 <a href="/home">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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