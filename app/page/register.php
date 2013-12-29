<?php
if (!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
if (isset($_POST['process'])) {
    if ($qls->User->register_user()) {
        switch ($qls->config['activation_type']) {
            default:
                $error = REGISTER_SUCCESS_NO_ACTIVATION;
                break;
            case 1:
                $error = REGISTER_SUCCESS_USER_ACTIVATION;
                break;
            case 2:
                $error = REGISTER_SUCCESS_ADMIN_ACTIVATION;
                break;
        }
    } else {
        $error = $qls->User->register_error . REGISTER_TRY_AGAIN;
    }
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
    <img src="/assets/img/logo.png" alt="" /> 
  </div>
  <div class="content">
    <form class="form-vertical login-form" id="frm1" action="register<?php
if (isset($_GET['code'])) {
?>/code<?php
    echo htmlentities($_GET['code']);
}
?>" method="post" />
      	<input type="hidden" name="process" value="true" />
	  <h3 class="form-title">Registracija</h3>
      <div class="control-group">
        <div class="controls">
		<?php echo $error; ?>
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" name="username" maxlength="<?php
echo $qls->config['max_username'];
?>" type="text" placeholder="Korisnicko Ime" />
		  </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap" placeholder="Lozinka" type="password" name="password" maxlength="<?php
echo $qls->config['max_password'];
?>" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap" placeholder="Potvrdite Lozinku" type="password" name="password_c" maxlength="<?php
echo $qls->config['max_password'];
?>" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" placeholder="Ime" type="text" name="firstname" maxlength="40" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" placeholder="Prezime" type="text" name="lastname" maxlength="40" />
          </div>
        </div>
      </div>
	  	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" type="date" name="years" maxlength="100" />
          </div>
        </div>
      </div>
	  	<div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-phone"></i>
            <input class="m-wrap" placeholder="Telefon" type="text" name="phone" maxlength="100" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-envelope"></i>
            <input class="m-wrap" placeholder="Email" type="text" name="email" maxlength="100" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-envelope"></i>
            <input class="m-wrap" placeholder="Potvrdite Email" type="text" name="email_c" maxlength="100" />
          </div>
        </div>
      </div>
	  	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input name="country" placeholder="Drzava" type="text" class="m-wrap" style="margin: 0 auto;" data-provide="typeahead" data-items="4" list="country"/>
			<datalist id="country">
			<option value="Afghanistan">
			<option value="Albania">
			<option value="Algeria">
			<option value="Andorra">
			<option value="Angola">
			<option value="Antigua & Deps">
			<option value="Argentina">
			<option value="Armenia">
			<option value="Australia">
			<option value="Austria">
			<option value="Azerbaijan">
			<option value="Bahamas">
			<option value="Bahrain">
			<option value="Bangladesh">
			<option value="Barbados">
			<option value="Belarus">
			<option value="Belgium">
			<option value="Belize">
			<option value="Benin">
			<option value="Bhutan">
			<option value="Bolivia">
			<option value="Bosnia Herzegovina">
			<option value="Botswana">
			<option value="Brazil">
			<option value="Brunei">
			<option value="Bulgaria">
			<option value="Burkina">
			<option value="Burundi">
			<option value="Cambodia">
			<option value="Cameroon">
			<option value="Canada">
			<option value="Cape Verde">
			<option value="Central African Rep">
			<option value="Chad">
			<option value="Chile">
			<option value="China">
			<option value="Colombia">
			<option value="Comoros">
			<option value="Congo">
			<option value="Congo {Democratic Rep}">
			<option value="Costa Rica">
			<option value="Croatia">
			<option value="Cuba">
			<option value="Cyprus">
			<option value="Czech Republic">
			<option value="Denmark">
			<option value="Djibouti">
			<option value="Dominica">
			<option value="Dominican Republic">
			<option value="Timor Leste">
			<option value="Ecuador">
			<option value="Egypt">
			<option value="El Salvador">
			<option value="Equatorial Guinea">
			<option value="Eritrea">
			<option value="Estonia">
			<option value="Ethiopia">
			<option value="Fiji">
			<option value="Finland">
			<option value="France">
			<option value="Gabon">
			<option value="Gambia">
			<option value="Georgia">
			<option value="Germany">
			<option value="Ghana">
			<option value="Greece">
			<option value="Grenada">
			<option value="Guatemala">
			<option value="Guinea">
			<option value="Guinea-Bissau">
			<option value="Guyana">
			<option value="Haiti">
			<option value="Honduras">
			<option value="Hungary">
			<option value="Iceland">
			<option value="India">
			<option value="Indonesia">
			<option value="Iran">
			<option value="Iraq">
			<option value="Ireland {Republic}">
			<option value="Israel">
			<option value="Italy">
			<option value="Ivory Coast">
			<option value="Jamaica">
			<option value="Japan">
			<option value="Jordan">
			<option value="Kazakhstan">
			<option value="Kenya">
			<option value="Kiribati">
			<option value="Korea North">
			<option value="Korea South">
			<option value="Kuwait">
			<option value="Kyrgyzstan">
			<option value="Laos">
			<option value="Latvia">
			<option value="Lebanon">
			<option value="Lesotho">
			<option value="Liberia">
			<option value="Libya">
			<option value="Liechtenstein">
			<option value="Lithuania">
			<option value="Luxembourg">
			<option value="Macedonia">
			<option value="Madagascar">
			<option value="Malawi">
			<option value="Malaysia">
			<option value="Maldives">
			<option value="Mali">
			<option value="Malta">
			<option value="Marshall Islands">
			<option value="Mauritania">
			<option value="Mauritius">
			<option value="Mexico">
			<option value="Micronesia">
			<option value="Moldova">
			<option value="Monaco">
			<option value="Mongolia">
			<option value="Montenegro">
			<option value="Morocco">
			<option value="Mozambique">
			<option value="Myanmar, {Burma}">
			<option value="Namibia">
			<option value="Nauru">
			<option value="Nepal">
			<option value="Netherlands">
			<option value="New Zealand">
			<option value="Nicaragua">
			<option value="Niger">
			<option value="Nigeria">
			<option value="Norway">
			<option value="Oman">
			<option value="Pakistan">
			<option value="Palau">
			<option value="Panama">
			<option value="Papua New Guinea">
			<option value="Paraguay">
			<option value="Peru">
			<option value="Philippines">
			<option value="Poland">
			<option value="Portugal">
			<option value="Qatar">
			<option value="Romania">
			<option value="Russian Federation">
			<option value="Rwanda">
			<option value="St Kitts & Nevis">
			<option value="St Lucia">
			<option value="Saint Vincent & the Grenadines">
			<option value="Samoa">
			<option value="San Marino">
			<option value="Sao Tome & Principe">
			<option value="Saudi Arabia">
			<option value="Senegal">
			<option value="Serbia">
			<option value="Seychelles">
			<option value="Sierra Leone">
			<option value="Singapore">
			<option value="Slovakia">
			<option value="Slovenia">
			<option value="Solomon Islands">
			<option value="Somalia">
			<option value="South Africa">
			<option value="Spain">
			<option value="Sri Lanka">
			<option value="Sudan">
			<option value="Suriname">
			<option value="Swaziland">
			<option value="Sweden">
			<option value="Switzerland">
			<option value="Syria">
			<option value="Taiwan">
			<option value="Tajikistan">
			<option value="Tanzania">
			<option value="Thailand">
			<option value="Togo">
			<option value="Tonga">
			<option value="Trinidad & Tobago">
			<option value="Tunisia">
			<option value="Turkey">
			<option value="Turkmenistan">
			<option value="Tuvalu">
			<option value="Uganda">
			<option value="Ukraine">
			<option value="United Arab Emirates">
			<option value="United Kingdom">
			<option value="United States of America">
			<option value="Uruguay">
			<option value="Uzbekistan">
			<option value="Vanuatu">
			<option value="Vatican City">
			<option value="Venezuela">
			<option value="Vietnam">
			<option value="Yemen">
			<option value="Zambia">
			<option value="Zimbabwe">
			</datalist>
		  </div>
		<div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" placeholder="Grad" type="text" name="city" maxlength="40" />
          </div>
        </div>
      </div>
	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" placeholder="Ulica" type="text" name="street" maxlength="40" />
          </div>
        </div>
      </div>
	  	  <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" placeholder="Ovde mozete da upisete nesto o sebi
" type="text" name="about" maxlength="400" />
          </div>
        </div>
      </div>
        </div>
      </div>
      <div class="form-actions">
       <center><input type="submit" value="Registracija" id="login-btn" class="btn green"></center>
	  </div>
    </form>
  </div>
  <div class="copyright">
    2013 <a href="index">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
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