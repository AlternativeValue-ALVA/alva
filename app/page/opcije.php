<?php
if(!defined('QUADODO_IN_SYSTEM'))
{
	exit;
}
?>
<link href="assets/css/profile.css" rel="stylesheet" />
	<link href="assets/js/bootstrap-fileupload.css" rel="stylesheet" />
      <div class="page-content">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">		
			<h3 class="page-title"><?php echo $qls->user_info['firstname']; ?> <?php echo $qls->user_info['lastname']; ?></h3>
			<ul class="breadcrumb">
				<li>
					<i class="icon-user"></i>
					<a href="profile.php">Moj Profil</a> 
				</li>
			</ul>
               </div>
            </div>
            <div class="row-fluid profile">
               <div class="span12">
                  <div class="tabbable tabbable-custom tabbable-full-width">
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1_1" data-toggle="tab">Pregeld</a></li>
                        <li><a href="#tab_1_2" data-toggle="tab">Informacije</a></li>
                        <li><a href="#tab_1_3" data-toggle="tab">Postavke</a></li>
                        <li><a href="#tab_1_4" data-toggle="tab">Poslovi</a></li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane row-fluid active" id="tab_1_1">
                           <ul class="unstyled profile-nav span3">
                              <li><img src="crc/<?php
echo md5($qls->user_info['username']);
?>.jpg" alt="" /></li>
                              <li><a href="#">Poslovi</a></li>
                              <li><a href="#">Poruke</a></li>
                              <li><a href="#">Prijatelji</a></li>
                           </ul>
                           <div class="span9">
                              <div class="row-fluid">
                                 <div class="span8 profile-info">
                                    <h1><?php
echo $qls->user_info['firstname'];
?> <?php
echo $qls->user_info['lastname'];
?></h1>
                                    <p><?php
echo $qls->user_info['about'];
?></p>
                                    <p><a href="#"></a></p>
                                    <ul class="unstyled inline">
                                       <li><i class="icon-map-marker"></i> <?php
echo $qls->user_info['country'];
?></li>
                                       <li><i class="icon-calendar"></i> <?php
echo $qls->user_info['years'];
?></li>
									   <?php
if($qls->user_info['topseller'] == 1)
	echo '<li><i class="icon-star"></i> Top Prodavac</li>';
?>
                                    </ul>
                                 </div>
                                 <div class="span4">
                                    <div class="portlet sale-summary">
                                       <div class="portlet-title">
                                          <div class="caption">Alva Stats</div>
                                       </div>
                                       <ul class="unstyled">
                                          <li>
                                             <span class="sale-info">POSLATO    <i class="icon-img-up"></i></span> 
                                             <span class="sale-num"><?php
echo $qls->user_info['poslate'];
?></span>
                                          </li>
                                          <li>
                                             <span class="sale-info">PRIMLJENO <i class="icon-img-down"></i></span> 
                                             <span class="sale-num"><?php
echo $qls->user_info['primljene'];
?></span>
                                          </li>
                                          <li>
                                             <span class="sale-info">ALVA</span> 
                                             <span class="sale-num"><?php
echo $qls->user_info['alve'];
?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div class="tabbable tabbable-custom tabbable-custom-profile">
                                 <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1_11" data-toggle="tab">Poslednje Transakcije</a></li>
                                 </ul>
                                 <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_11">
                                       <div class="portlet-body" style="display: block;">
                                          <table class="table table-striped table-bordered table-advance table-hover">
                                             <thead>
                                                <tr>
                                                   <th><i class="icon-user"></i> Osoba</th>
                                                   <th class="hidden-phone"><i class="icon-question-sign"></i> Kolicina</th>
                                                   <th><i class="icon-bookmark"></i> Opis</th>
                                                   <th></th>
                                                </tr>
                                             </thead>
                                             <tbody>
											 <?php
$idd         = $qls->user_info['id'];
$transakcije = $qls->SQL->query("SELECT * FROM `{$qls->config['sql_prefix']}transakcije` WHERE (idko = '$idd' OR idkome = '$idd') ORDER BY id DESC");
while($users_row = $qls->SQL->fetch_array($transakcije))
{
?>
	<tr>
	<?php
	if($users_row['idkome'] == $idd)
	{
?>
			<td><a href="profile.php?u=<?php
		echo stripslashes($qls->id_to_username($users_row['idko']));
?>"><?php
		echo stripslashes($qls->id_to_username($users_row['idko']));
?></a></td>
			<?php
	}
	else
	{
?>
	
<td><a href="profile.php?u=<?php
		echo stripslashes($qls->id_to_username($users_row['idkome']));
?>"><?php
		echo stripslashes($qls->id_to_username($users_row['idkome']));
?></a></td>
			<?php
	}
?>
    <td><?php
	if($users_row['idkome'] == $idd)
	{
?>
		<span class="label label-success label-mini">Primljeno</span> <?php
	}
	else
	{
?><span class="label label-important label-mini">Poslato</span> <?php
	}
?><?php
	echo $users_row['kolko'];
?></td>
	<td class="hidden-phone"><?php
	echo $users_row['zasto'];
?></td>
    <td><a class="btn mini blue-stripe" href="trans.php?id=<?php
	echo $users_row['id'];
?>">Detaljnije</a></td>
   </tr>
<?php
}
?>
                                                <tr>
                                                   <td><a href="#">ALVA</a></td>
												    <td><span class="label label-success label-mini">Primljeno</span> 500</td>
                                                   <td class="hidden-phone">Rodjenje</td>
                                                   <td><a class="btn mini blue-stripe" href="">Detaljnije</a></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                           
									 </div>
								  </div>
							   </div>
							</div>
						
                        <div class="tab-pane profile-classic row-fluid" id="tab_1_2">
                           <div class="span2"><img src="crc/<?php echo md5($qls->user_info['username']);?>.jpg" alt="" /></div>
                           <ul class="unstyled span10">
                              <li><span>Korisnicko Ime:</span> <?php echo $qls->user_info['username']; ?></li>
                              <li><span>Ime:</span> <?php echo $qls->user_info['firstname']; ?></li>
                              <li><span>Prezime:</span> <?php echo $qls->user_info['lastname']; ?></li>
                              <li><span>Zemlja:</span> <?php echo $qls->user_info['country']; ?></li>
                              <li><span>Datum Rodenja:</span> <?php echo $qls->user_info['years']; ?></li>
                              <li><span>Email:</span> <a href="#"><?php echo $qls->user_info['email']; ?></a></li>
                              <li><span>Telefon:</span> <?php echo $qls->user_info['phone']; ?></li>
                              <li><span>O Sebi:</span> <?php echo $qls->user_info['about']; ?></li>
                           </ul>
                        </div>
                        
                        <div class="tab-pane row-fluid profile-account" id="tab_1_3">
                           <div class="row-fluid">
                              <div class="span12">
                                 <div class="span3">
                                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                                       <li class="active">
                                          <a data-toggle="tab" href="#tab_1-1">
                                          <i class="icon-cog"></i> 
                                          Informacije
                                          </a> 
                                          <span class="after"></span>                                    
                                       </li>
                                       <li class=""><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> Avatar</a></li>
                                       <li class=""><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> Lozinka</a></li>
                                       <li class=""><a data-toggle="tab" href="#tab_4-4"><i class="icon-eye-open"></i> Sigurnost</a></li>
                                    </ul>
                                 </div>
                                 <div class="span9">
                                    <div class="tab-content">
                                       <div id="tab_1-1" class="tab-pane active">
                                          <div style="height: auto;" id="accordion1-1" class="accordion collapse">
                                             <form action="#">
                                                <label class="control-label">Ime</label>
                                                <input type="text" placeholder="<?php echo $qls->user_info['firstname']; ?>" class="m-wrap span8" />
                                                <label class="control-label">Prezime</label>
                                                <input type="text" placeholder="<?php echo $qls->user_info['lastname']; ?>" class="m-wrap span8" />
                                                <label class="control-label">Telefon</label>
                                                <input type="text" placeholder="<?php echo $qls->user_info['phone']; ?>" class="m-wrap span8" />
                                                <label class="control-label">Zemlja</label>
                                                <input name="country" placeholder="<?php echo $qls->user_info['country']; ?>" type="text" class="m-wrap" style="margin: 0 auto;" data-provide="typeahead" data-items="4" list="country"/>
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
                                                <label class="control-label">O Sebi</label>
                                                <textarea class="span8 m-wrap" rows="3"><?php echo $qls->user_info['about']; ?></textarea>
                                                <div class="submit-btn">
                                                   <a href="#" class="btn green">Sacuvaj Promene</a>
                                                   <a href="#" class="btn red">Izadji</a>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <div id="tab_2-2" class="tab-pane">
                                          <div style="height: auto;" id="accordion2-2" class="accordion collapse">
                                             <form action="ar.php" method="post" enctype="multipart/form-data" name="form2" id="form2">
                                                <p>Avatar je tu da bi vi prikazali kako izgledate.</p>
                                                <br />
                                                <div class="controls">
                                                   <div class="thumbnail" style="width: 291px; height: 170px;">
                                                      <img height="291" width="170" src="crc/<?php echo md5($qls->user_info['username']);?>.jpg" alt="" />
                                                   </div>
                                                </div>
                                                <div class="space10"></div>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                   <div class="input-append">
                                                      <div class="uneditable-input">
                                                         <i class="icon-file fileupload-exists"></i> 
                                                         <span class="fileupload-preview"></span>
                                                      </div>
                                                      <span class="btn btn-file" type="file" name="ifile">
                                                      <span class="fileupload-new">Izaberi Fajl</span>
                                                      <span class="fileupload-exists">Promeni</span>
                                                      <input name="ifile" type="file" class="default" />
                                                      </span>
													  <input type="hidden" name="5000000" value="500000" />
														
                                                      <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Ukloni</a>
                                                   </div>
                                                </div>
											<div class="clearfix"></div>
                                                <div class="space10"></div>
                                                <div class="submit-btn">
                                                   <input name="Submit"  class="btn green" type="submit" id="Submit" value="Upload">
                                                   <a href="#" class="btn">Prekni</a>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <div id="tab_3-3" class="tab-pane">
                                          <div style="height: auto;" id="accordion3-3" class="accordion collapse">
                                             <form action="#">
                                                <label class="control-label">Trenutna Lozinka</label>
                                                <input type="password" class="m-wrap span8" />
                                                <label class="control-label">Nova Lozinka</label>
                                                <input type="password" class="m-wrap span8" />
                                                <label class="control-label">Ponovno Nova Lozinka</label>
                                                <input type="password" class="m-wrap span8" />
                                                <div class="submit-btn">
                                                   <a href="#" class="btn green">Promeni Lozinku</a>
                                                   <a href="#" class="btn">Prekni</a>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <div id="tab_4-4" class="tab-pane">
                                          <div style="height: auto;" id="accordion4-4" class="accordion collapse">
                                             <form action="#">
                                                <div class="profile-settings row-fluid">
                                                   <div class="span9">
                                                      <p>Postavi ime i prezime svima javno</p>
                                                   </div>
                                                   <div class="control-group span3">
                                                      <div class="controls">
                                                         <label class="radio">
                                                         <input type="radio" name="optionsRadios1" value="option1" />
                                                         Da
                                                         </label>
                                                         <label class="radio">
                                                         <input type="radio" name="optionsRadios1" value="option2" checked />
                                                         Ne
                                                         </label>  
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <div class="profile-settings row-fluid">
                                                   <div class="span9">
                                                      <p>Ko moze videti vas profil</p>
                                                   </div>
                                                   <div class="control-group span3">
                                                      <div class="controls">
                                                         <label class="checkbox">
                                                         <input type="checkbox" value="" /> Svi
                                                         </label>
                                                         <label class="checkbox">
                                                         <input type="checkbox" value="" /> Prijatelji
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <div class="profile-settings row-fluid">
                                                   <div class="span9">
                                                      <p>Dozvoliti svima da vas nadju u pretrazi ?</p>
                                                   </div>
                                                   <div class="control-group span3">
                                                      <div class="controls">
                                                         <label class="checkbox">
                                                         <input type="checkbox" value="" /> Da
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <div class="profile-settings row-fluid">
                                                   <div class="span9">
                                                      <p>Slati anonimne podatke o koriscenju ALVA-i ?</p>
                                                   </div>
                                                   <div class="control-group span3">
                                                      <div class="controls">
                                                         <label class="checkbox">
                                                         <input type="checkbox" value="" /> Da
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <div class="profile-settings row-fluid">
                                                   <div class="span9">
                                                      <p>Koristiti BETA verziju ?</p>
                                                   </div>
                                                   <div class="control-group span3">
                                                      <div class="controls">
                                                         <label class="checkbox">
                                                         <input type="checkbox" value="" /> Da
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                <div class="space5"></div>
                                                <div class="submit-btn">
                                                   <a href="#" class="btn green">Sacuvaj Izmene</a>
                                                   <a href="#" class="btn">Prekini</a>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                                                    
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="footer">
      2013 <a href="home.php">ALVA-SITE</a> is part of ALVA ! ALVA-SITE is under the <a href="http://en.wikipedia.org/wiki/WTFPL">WTFPL</a>.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-angle-up"></i></span>
      </div>
   </div>
   <script src="assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>   
   <script src="assets/jquery-ui/jquery-ui.js" type="text/javascript"></script>      
   <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <!--[if lt IE 9]>
   <script src="assets/css/excanvas.js"></script>
   <script src="assets/css/respond.js"></script>  
   <![endif]-->   
   <script src="assets/breakpoints/breakpoints.js" type="text/javascript"></script>  
   <script src="assets/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/js/jquery.blockui.js" type="text/javascript"></script>  
   <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
   <script src="assets/uniform/jquery.uniform.min.js" type="text/javascript" ></script> 
   <script type="text/javascript" src="assets/js/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script src="assets/js/app.js"></script>				
	<script>
		jQuery(document).ready(function() {		
			App.init();
		});
	</script>
</html>