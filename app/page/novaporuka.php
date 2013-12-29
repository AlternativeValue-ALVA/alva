<?php
include('app/head.php');
?>
		<div class="page-content" style="min-height:1071px !important">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<h3 class="page-title">
							Inbox <small>Nova Poruka</small>
						</h3>
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
							<li class="inbox">
								<a href="/inbox" class="btn" data-title="Inbox">Inbox</a>
								<b></b>
							</li>
							<li class="/inbox/sent/"><a class="btn" href="javascript:;" data-title="Poslate">Poslate</a><b></b></li>
							<li class="/inbox/junk/"><a class="btn" href="javascript:;" data-title="Obrisane">Obrisane</a><b></b></li>
						</ul>
					</div>
					<div class="span10">
						<div class="inbox-header">
							<h1 class="pull-left">Nova Poruka</h1>
						</div>
						<form id="form1" name="form1" method="post" action="/app/np_process.php">
	<div class="inbox-compose-btn">
		<button class="btn blue"><i class="icon-check"></i>Posalji</button>
		<button class="btn">Odbaci</button>
	</div>
	<div class="inbox-control-group mail-to">
		<label class="control-label">Za:</label>
					<input type="text" value="<?php echo $get; ?>" class="m-wrap span12" name="za">
	</div>
	<div class="inbox-control-group">
		<label class="control-label">Naslov:</label>
		<div class="controls">
				<input type="text" class="m-wrap span12" name="naslov">
		</div>
	</div>
	<div class="inbox-control-group">
		<label class="control-label">Poruka:</label>
		<div class="controls">
				<div class="controls controls-to"><div class="tags span12"><input name="poruka" type="text" class="m-wrap"><tester style="position: absolute; top: -9999px; left: -9999px; width: auto; padding-left: 6px; padding-right: 6px; font-size: 14px; font-family: 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: 400; letter-spacing: 0px; white-space: nowrap;"></tester></div></div>
		</div>
	</div>
	<div class="inbox-compose-btn">
		<button class="btn blue"><i class="icon-check"></i>Posalji</button>
		<button class="btn">Ponisti</button>
	</div>
</form></div>
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
	<script src="/assets/bootstrap-tag/js/bootstrap-tag.js" type="text/javascript"></script> 
	<script src="/assets/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script> 
	<script src="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
	<script src="/assets/js/app.js"></script>      
	<script src="/assets/js/inbox.js"></script>    
	<script>
		jQuery(document).ready(function() {       
		   App.init();
		   Inbox.init();
		});
	</script>
</body></html>