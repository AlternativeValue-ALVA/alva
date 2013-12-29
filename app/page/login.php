<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;	
}
if ($qls->user_info['username'] != '') {
	header('Location: ' . $site . '/home');
	die;
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title>ALVA</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Alternativna Valuta" name="description" />
  <meta content="Momcilo m0k1 Micanovic" name="author" />
  <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/metro.css" rel="stylesheet" />
  <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/style_responsive.css" rel="stylesheet" />
  <link href="/assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="/assets/uniform/css/uniform.default.css" />
  <link rel="shortcut icon" href="favicon.ico" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body class="login">
  <div class="logo">
    <a href="index"><img src="/assets/img/logo.png" alt="" /></a>
  </div>
  <div class="content">
    <form class="form-vertical login-form" id="frm1" action="/app/login_process.php" method="post" />
      <input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Login</h3>
	  <?php
	  if($get != '')
	  {
		if($get == "odobren")
		{
			echo '<b><font color="red">Vase korisnicki racun jos nije odobren !</font></b><br>';
		}
		else if($get == "block")
		{
			echo '<b><font color="red">Vase korisnicki racun je blokiran !</font></b><br>';
		}
		else if($get == "pw")
		{
			echo '<b><font color="red">Uneli ste pogresnu lozinku !</font></b><br>';
		}
		else if($get == "pokusaj")
		{
			echo '<b><font color="red">Uneli ste pogresnu lozinku previse puta. Sacekajte 30min!</font></b><br>';
		}
		else if($get == "popuniti")
		{
			echo '<b><font color="red">Morate popuniti sva polja pre logina</font></b><br>';
		}
		else
		{
			echo '<b><font color="red">Neigraj se sa url !!!</font></b><br>';
		}
	  }
	  ?>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="username" maxlength="<?php echo $qls->config['max_username']; ?>" type="text" placeholder="Username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap" name="password" maxlength="<?php echo $qls->config['max_password']; ?>" type="password" style="" placeholder="Password" />
          </div>
        </div>
      </div>
      <div class="form-actions">
       <label class="checkbox"><input type="checkbox"name="remember" value="1" />Upamti me</label>
       <input type="submit" value="Login" id="login-btn" class="btn green pull-right">
	   <a href="/register"  class="btn red pull-right">Registracija</a>
	  </div>
      <div class="forget-password">
        <h4>Zaboravili ste lozinku ?</h4>
        <p>Bez brige, klikni <a href="/amnesia" id="forget-form">ovde</a> da resetujes svoju lozinku.</p>
      </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="https://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
  </div>
  <script src="/assets/js/jquery-1.8.3.min.js"></script>
  <script src="/assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="/assets/uniform/jquery.uniform.min.js"></script> 
  <script src="/assets/js/jquery.blockui.js"></script>
  <script src="/assets/js/app.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
</body>
</html>