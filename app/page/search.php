<?php
require_once('app/main.php');
include ('app/head.php');
?>
      <div class="page-content">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">	
			<h3 class="page-title">Rezultati pretrage</h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="home.php">Home</a> 
										
					<i class="icon-angle-right"></i>
									</li>
				<li><a href="#">Rezultati Pretrage</a></li>
						
						
			</ul>
               </div>
            </div>
            
            <div class="row-fluid">
               <div class="tabbable tabbable-custom tabbable-full-width">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#tab_2_2">User Search</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="tab_2_2" class="tab-pane active">

                        <div class="row-fluid search-forms search-default">
                           <form class="form-search" action="#">
                              <div class="chat-form">
                                 <div class="input-cont">   
                                    <input type="text" placeholder="Search..." class="m-wrap" />
                                 </div>
                                 <button type="button" class="btn green">Search &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                              </div>
                           </form>
                        </div>
                        <div class="portlet-body">
                           <table class="table table-striped table-hover">
                              <thead>
                                 <tr>
                                    <th>Photo</th>
                                    <th class="hidden-phone">Fullname</th>
                                    <th>Username</th>
                                    <th class="hidden-phone">Joined</th>
                                    <th class="hidden-phone">Points</th>
                                    <th>Status</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><img src="assets/img/avatar1.jpg" alt="" /></td>
                                    <td class="hidden-phone">Mark Nilson</td>
                                    <td>makr124</td>
                                    <td class="hidden-phone">19 Jan 2012</td>
                                    <td class="hidden-phone">1245</td>
                                    <td><span class="label label-success">Approved</span></td>
                                    <td><a class="btn mini red-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar2.jpg" alt="" /></td>
                                    <td class="hidden-phone">Filip Rolton</td>
                                    <td>jac123</td>
                                    <td class="hidden-phone">09 Feb 2012</td>
                                    <td class="hidden-phone">15</td>
                                    <td><span class="label label-info">Pending</span></td>
                                    <td><a class="btn mini blue-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar3.jpg" alt="" /></td>
                                    <td class="hidden-phone">Colin Fox</td>
                                    <td>col</td>
                                    <td class="hidden-phone">19 Jan 2012</td>
                                    <td class="hidden-phone">245</td>
                                    <td><span class="label label-warning">Suspended</span></td>
                                    <td><a class="btn mini green-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar.png" alt="" /></td>
                                    <td class="hidden-phone">Nick Stone</td>
                                    <td>sanlim</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">565</td>
                                    <td><span class="label label-danger">Blocked</span></td>
                                    <td><a class="btn mini red-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar1.jpg" alt="" /></td>
                                    <td class="hidden-phone">Edward Cook</td>
                                    <td>sanlim</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">45245</td>
                                    <td><span class="label label-danger">Blocked</span></td>
                                    <td><a class="btn mini green-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar.png" alt="" /></td>
                                    <td class="hidden-phone">Nick Stone</td>
                                    <td>sanlim</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">24512</td>
                                    <td><span class="label label-danger">Blocked</span></td>
                                    <td><a class="btn mini blue-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar1.jpg" alt="" /></td>
                                    <td class="hidden-phone">Elis Lim</td>
                                    <td>makr124</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">145</td>
                                    <td><span class="label label-success">Approved</span></td>
                                    <td><a class="btn mini red-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar2.jpg" alt="" /></td>
                                    <td class="hidden-phone">King Paul</td>
                                    <td>king123</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">456</td>
                                    <td><span class="label label-info">Pending</span></td>
                                    <td><a class="btn mini blue-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar3.jpg" alt="" /></td>
                                    <td class="hidden-phone">Filip Larson</td>
                                    <td>fil</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">12453</td>
                                    <td><span class="label label-warning">Suspended</span></td>
                                    <td><a class="btn mini green-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar.png" alt="" /></td>
                                    <td class="hidden-phone">Martin Larson</td>
                                    <td>larson12</td>
                                    <td class="hidden-phone">01 Apr 2011</td>
                                    <td class="hidden-phone">2453</td>
                                    <td><span class="label label-danger">Blocked</span></td>
                                    <td><a class="btn mini red-stripe" href="#">View</a></td>
                                 </tr>
                                 <tr>
                                    <td><img src="assets/img/avatar1.jpg" alt="" /></td>
                                    <td class="hidden-phone">King Paul</td>
                                    <td>sanlim</td>
                                    <td class="hidden-phone">11 Mar 2012</td>
                                    <td class="hidden-phone">905</td>
                                    <td><span class="label label-danger">Blocked</span></td>
                                    <td><a class="btn mini green-stripe" href="#">View</a></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div class="space5"></div>
                        <div class="pagination pagination-right">
                           <ul>
                              <li><a href="#">Prev</a></li>
                              <li><a href="#">1</a></li>
                              <li><a href="#">2</a></li>
                              <li class="active"><a href="#">3</a></li>
                              <li><a href="#">4</a></li>
                              <li><a href="#">5</a></li>
                              <li><a href="#">Next</a></li>
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
      2013 <a href="index.php">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-angle-up"></i></span>
      </div>
   </div>
   
   
   
   <script src="assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>   
     
   <script src="assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>      
   <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      
      <script src="assets/fancybox/source/jquery.fancybox.pack.js"></script>

   <script src="assets/breakpoints/breakpoints.js" type="text/javascript"></script>  
   <script src="assets/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/js/jquery.blockui.js" type="text/javascript"></script>  
   <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
   <script src="assets/uniform/jquery.uniform.min.js" type="text/javascript" ></script> 
   <script type="text/javascript" src="assets/js/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script src="assets/js/app.js"></script>
	<script src="assets/js/search.js"></script>
	<script>
		jQuery(document).ready(function() {		
			App.init(); // init the rest of plugins and elements
			Search.init(); // init the rest of plugins and elements
		});
	</script>
</html>