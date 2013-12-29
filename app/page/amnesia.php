<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;	
}
if ($qls->user_info['username'] != '') {
	header('Location: ' . $site . '/home');
	die;
}
if ($qls->User->check_password_code()) 
{
	if (isset($_POST['process'])) 
	{
		if ($qls->User->change_password()) 
		{
			header('Location: '.$site.'/amnesia/resetpwok');
		}
		else {
			header('Location: '.$site.'/amnesia/resetpwwrong/'.$get2);
		}
	}
	else 
	{
	header('Location: '.$site.'/amnesia/resetpw/'.$get2);
	}
}
else 
{
	if (isset($_POST['process'])) 
	{
		if ($qls->User->send_password_email()) 
		{
			header('Location: '.$site.'/amnesia/ok');
		}
		else 
		{
			header('Location: '.$site.'/amnesia/wrong');
//echo "<br>wrong - amensia.php - 37 <br>";
		}
	}
}
if($get == "")
{
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
    <form class="form-vertical login-form" id="frm1" action="/amnesia" method="post" />
      <input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Zaboravli ste lozinku ? Molimo vas unesite vas email.</h3>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="email" type="text" placeholder="email" />
          </div>
        </div>
      </div>
      <div class="form-actions">
       <input type="submit" value="Reset Password" id="login-btn" class="btn green pull-right">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
else if($get == "ok")
{
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
    <form class="form-vertical login-form" id="frm1" />
	  <h3 class="form-title">Email uspesno poslat, molimo proverite svoj inbox.</h3>
      <div class="form-actions">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
else if($get == "wrong")
{
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
    <form class="form-vertical login-form" id="frm1" action="/amnesia" method="post" />
      <input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Doslo je do greske ... Molimo pokusajte ponovo.</h3>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="email" type="text" placeholder="email" />
          </div>
        </div>
      </div>
      <div class="form-actions">
       <input type="submit" value="Reset Password" id="login-btn" class="btn green pull-right">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
else if($get == "resetpw")
{
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
    <form class="form-vertical login-form" id="frm1" action="/app/resetpw.php?c=<?php echo $get2; ?>" method="post" />
      <input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Unesite novu lozinku koju zelite da postavite.</h3>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="new_password" maxlength="<?php echo $qls->config['max_username']; ?>" type="text" placeholder="Nova lozinka" />
          </div>
		  <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="new_password_confirm" maxlength="<?php echo $qls->config['max_username']; ?>" type="text" placeholder="Ponovite novu lozinku" />
          </div>
        </div>
      </div>
      <div class="form-actions">
       <input type="submit" value="Promeni Lozinku" id="login-btn" class="btn green pull-right">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
else if($get == "resetpwok")
{
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
    <form class="form-vertical login-form" id="frm1" />
	  <h3 class="form-title">Vasa lozinka je uspesno promenjena.</h3>
      <div class="form-actions">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
else if($get == "resetpwwrong")
{
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
    <form class="form-vertical login-form" id="frm1" action="/app/resetpw.php?c=<?php echo $get2; ?>" method="post" />
      <input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Doslo je do greske ... Molimo pokusajte ponovo.</h3>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="new_password" maxlength="<?php echo $qls->config['max_username']; ?>" type="text" placeholder="Nova lozinka" />
          </div>
		  <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="new_password_confirm" maxlength="<?php echo $qls->config['max_username']; ?>" type="text" placeholder="Ponovite novu lozinku" />
          </div>
        </div>
      </div>
      <div class="form-actions">
       <input type="submit" value="Promeni Lozinku" id="login-btn" class="btn green pull-right">
	   <a href="/login"  class="btn red pull-right">Nazad</a>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="http://alva.rs">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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
<?php 
}
?>