<?php
include('app/head.php');
?>
<link href="/assets/css/profile.css" rel="stylesheet" />
<link href="/assets/js/bootstrap-fileupload.css" rel="stylesheet" />
		<div class="page-content">
		<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">	
			<h3 class="page-title">Dodaj Novi</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-comment"></i>
					<a href="/res">Resursi</a> 				
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="dodajres">Dodaj Novi</a></li>		
			</ul>
               </div>
            </div>
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">Dodaj Novi</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">
                        <div class="portlet-body">    
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="app/dr_process.php" enctype="multipart/form-data">
<td>	
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td width="14%"><strong>Naslov</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="naslov" type="text" id="naslov" size="50" /></td>
</tr>
<tr>
<td width="14%"><strong>Slika</strong></td>
<td width="2%">:</td>
<td width="84%"> <div class="fileupload fileupload-new" data-provides="fileupload">
                                                   <div class="input-append">
                                                      <div class="uneditable-input">
                                                         <i class="icon-file fileupload-exists"></i> 
                                                         <span class="fileupload-preview"></span>
                                                      </div>
                                                      <span class="btn btn-file" type="file" name="slika">
                                                      <span class="fileupload-new">Izaberi Fajl</span>
                                                      <input name="slika" id="slika" type="file" class="default" />
                                                      </span>
													  <input type="hidden" name="5000000" value="500000" />
														
                                               
                                                   </div>
                                                </div></td>
</tr>
<tr>
<td valign="top"><strong>Opis</strong></td>
<td valign="top">:</td>
<td><input name="opis" type="text" id="opis" size="50" /></textarea></td>
</tr>
<tr>
<td valign="top"><strong>Vrednost</strong></td>
<td valign="top">:</td>
<td><input name="cena" type="text" id="cena" size="50" /></td>
</tr>
<tr>
<td valign="top"><strong>Tagovi</strong></td>
<td valign="top">:</td>
<td><input name="tag" type="text" id="tag" size="50" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit"  name="Submit" value="Dodaj Resurs" class="btn green"><input  class="btn red" type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
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
	<script src="/assets/js/search.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.init(); // init the rest of plugins and elements
			Search.init(); // init the rest of plugins and elements
		});
	</script>
</html>