<?php
if (!defined('QUADODO_IN_SYSTEM')) {
    exit;
}

/**
 * Contains all user functions
 */
class User
{
    
    /**
     * @var object $qls - Will contain everything else
     */
    var $qls;
    
    /**
     * Construct class
     * @param object $qls - Contains all other classes
     * @return void
     */
    function User(&$qls)
    {
        $this->qls =& $qls;
    }
    
    /**
     * Un-activates accounts that need un-activation
     * @return void
     */
    function check_activated_accounts()
    {
        $groups_result = $this->qls->SQL->query("SELECT * FROM `{$this->qls->config['sql_prefix']}groups` WHERE `expiration_date`<>0");
        // Get the groups and put them into a variable
        while ($groups_row = $this->qls->SQL->fetch_array($groups_result)) {
            // Find the amount of seconds the admin entered
            $in_seconds   = time() - ($groups_row['expiration_date'] * 86400);
            $users_result = $this->qls->SQL->query("SELECT * FROM `{$this->qls->config['sql_prefix']}users` WHERE `group_id`={$groups_row['id']} AND `activation_time`<{$in_seconds} AND `active`='yes'");
            while ($users_row = $this->qls->SQL->fetch_array($users_result)) {
                // Un-activate them
                $this->qls->SQL->update('users', array(
                    'active' => 'no'
                ), array(
                    'id' => array(
                        '=',
                        $users_row['id']
                    )
                ));
            }
        }
    }
    
    /**
     * Checks the password code via the GET method
     * @return true if valid false if not
     */
    function check_password_code()
    {
		$get2 = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['c']);
        $result = $this->qls->SQL->select('*', 'password_requests', array(
            'code' => array(
                '=',
                $get2
            )
        ));

        $row    = $this->qls->SQL->fetch_array($result);
        if ($row['id'] != '' && $row['used'] != 1) {
			return true;
        } else {
            return false;
        }
    }
    
    /**
     * This will actually change the password of the user
     * @return true on success, false on failure
     */
    function change_password()
    {
        // A little extra security
        if ($this->check_password_code()) {
            $code = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['c']);
            // Retrieve the information from the database
            $result = $this->qls->SQL->select('*', 'password_requests', array(
                'code' => array(
                    '=',
                    $code
                )
            ));
            $row    = $this->qls->SQL->fetch_array($result);
            // Get the user's username from the database
            $users_result = $this->qls->SQL->select('*', 'users', array(
                'id' => array(
                    '=',
                    $row['user_id']
                )
            ));
            $users_row    = $this->qls->SQL->fetch_array($users_result);
            $new_password         = (isset($_POST['new_password']) && $this->validate_password($_POST['new_password'])) ? $this->qls->Security->make_safe($_POST['new_password']) : false;
            $new_password_confirm = (isset($_POST['new_password_confirm']) && $_POST['new_password_confirm'] == $_POST['new_password']) ? true : false;
			if ($new_password !== false && $new_password_confirm !== false) {
                $password_hash = $this->generate_password_hash($new_password, $users_row['code']);
                
                // Update the database
                $this->qls->SQL->update('users', array(
                    'password' => $password_hash
                ), array(
                    'id' => array(
                        '=',
                        $row['user_id']
                    )
                ));
                $this->qls->SQL->update('password_requests', array(
                    'used' => 1
                ), array(
                    'id' => array(
                        '=',
                        $row['id']
                    )
                ));
                return true;
            } else {
                $this->change_password_error = REGISTER_PASSWORD_ERROR;
                return false;
            }
        } else {
            $this->change_password_error = CHANGE_PASSWORD_INVALID_CODE;
            return false;
        }
    }
    
    /**
     * This will generate a random code
     * @return string of SHA1 hash
     */
    function generate_random_code()
    {
        $hash[] = sha1(sha1(rand(1, 100)) . md5(rand(1, 100)));
        $hash[] = sha1(time() + time() . md5(time() + time()) . md5(rand()));
        $hash[] = sha1($hash[0] . $hash[1] . md5(time()));
        $hash[] = sha1($this->qls->config['user_regex'] . time());
        return sha1($hash[0] . $hash[0] . $hash[1] . $hash[2] . $hash[3] . time() . time() + time());
    }
    
    /**
     * Sends the password change email to the user
     * @return true on success, false on failure
     */
    function send_password_email()
    {
        $username = $_POST['email'];
		//echo $username;
        if ($this->check_email_existance($username)) 
		{
			
			 $result = $this->qls->SQL->select('id', 'users', array(
                'email' => array(
                    '=',
                    $username
                )
            ));
			
            $row    = $this->qls->SQL->fetch_array($result);
            $code = $this->generate_random_code();
			$userid = $row['id'];
			$usernamee = $row['username'];
            $this->qls->SQL->insert('password_requests', array(
                'user_id',
                'code',
                'used',
                'date'
            ), array(
                $userid,
                $code,
                0,
                time()
            ));
            $user_info = $this->fetch_user_info($usernamee);
            $change_link = "Zatrazili ste promenu lozinke na http://alva.rs <br>Ako to niste bili vi onda zanemarite ovaj email. <br/> http://alva.rs/amnesia/resetpw/$code";
            
            $headers = "From: info@alva.rs \r\n";
            require("app/phpmailer/class.phpmailer.php");
			$mail = new PHPMailer(); 
			$webmaster_email = "info@alva.rs"; //Reply to this email ID
			$email= $username; // Recipients email ID
			$name= $user_info['username']; // Recipient's name
		//	echo $name;
			$mail->From = $webmaster_email;
			$mail->FromName = "Alva.rs Reset Password";
			$mail->AddAddress($email,$name);
			$mail->AddReplyTo($webmaster_email,"Alva.rs Reset Password");
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = "Alva.rs Password reset";
			$mail->Body = $change_link; //HTML Body
			$mail->AltBody = "Zatrazili ste promenu lozinke na http://alva.rs <br>Ako to niste bili vi onda zanemarite ovaj email. http://alva.rs/amnesia/resetpw/$code"; //Text Body
			if(!$mail->Send())
			{
				$this->send_password_email_error = SEND_PASSWORD_MAIL_ERROR;
                return false;
			}
			else
			{
				return true;
			}
			return true;
        }
    }
    
    /**
     * Transforms a username into an ID number
     * @param string $username - The username to change
     * @return the ID of the user in integer form
     */
    function username_to_id($username)
    {
        $username = $this->qls->Security->make_safe($username);
        // Make sure it exists 0.o
        if ($this->check_username_existance($username)) {
            $result = $this->qls->SQL->select('id', 'users', array(
                'username' => array(
                    '=',
                    $username
                )
            ));
            $row    = $this->qls->SQL->fetch_array($result);
            return $row['id'];
        } else {
            return 0;
        }
    }
    
    /**
     * Transform a user ID into a username
     * @param integer $user_id - The ID to change
     * @return a string containing the username
     */
    function id_to_username($user_id)
    {
        $user_id = (is_numeric($user_id) && $user_id > 0) ? $user_id : 0;
        $result  = $this->qls->SQL->select('username', 'users', array(
            'id' => array(
                '=',
                $user_id
            )
        ));
        $row     = $this->qls->SQL->fetch_array($result);
        return $row['username'];
    }
    
    /**
     * Validates a password
     * @param string $input - The input password
     * @return true if valid, false if not
     */
    function validate_password($input)
    {
        if (strlen($input) <= $this->qls->config['max_password'] && strlen($input) >= $this->qls->config['min_username']) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Validate the username according to the defined regex string.
     * @param string $input - The input username
     * @return true if valid, false if not
     */
    function validate_username($input)
    {
        if (preg_match($this->qls->config['user_regex'], $input)) {
            if (strlen($input) <= $this->qls->config['max_username'] && strlen($input) >= $this->qls->config['min_username']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	function validate_email($input)
    {
		if(strlen($input) > 6 && strlen($input) < 256)
		{
			if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $input))
			{
				return true;
            }
			else 
			{
                return false;
            }
		}
		else 
		{
			return false;
        }
    }
    
    /**
     * Validates the user that is logged in, not logging in a user
     * @return true on success, false on failure
     */
    function validate_login()
    {
        if ($this->qls->Session->find_session()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Fetch the user info of the user trying to login
     * @param string $username - The username
     * @return array containing info on success, false on failure
     */
    function fetch_user_info($username)
    {
        if ($this->validate_username($username)) {
            // Get info from the database
            $result = $this->qls->SQL->select('*', 'users', array(
                'username' => array(
                    '=',
                    $username
                )
            ));
            $row    = $this->qls->SQL->fetch_array($result);
            return $row;
        } else {
            return false;
        }
    }
    
    /**
     * Increases the number of tries by 1
     * @param string  $username      - The username
     * @param integer $current_tries - The user's current tries
     * @return void but will output error if found
     */
    function update_tries($username, $current_tries)
    {
        if ($this->validate_username($username)) {
            $this->qls->SQL->update('users', array(
                'tries' => ($current_tries + 1),
                'last_try' => time()
            ), array(
                'username' => array(
                    '=',
                    $username
                )
            ));
        }
    }
    
    /**
     * Generates the password hash
     * @param string $password  - The user's password
     * @param string $user_code - The user's activation code
     * @return SHA1 string
     */
    function generate_password_hash($password, $user_code)
    {
        $hash[] = md5($password);
        $hash[] = md5($password . $user_code);
        $hash[] = md5($password) . sha1($user_code . $password) . md5(md5($password));
        $hash[] = sha1($password . $user_code . $password);
        $hash[] = md5($hash[3] . $hash[0] . $hash[1] . $hash[2] . sha1($hash[3] . $hash[2]));
        $hash[] = sha1($hash[0] . $hash[1] . $hash[2] . $hash[3]) . md5($hash[4] . $hash[4]) . sha1($user_code);
        return sha1($hash[0] . $hash[1] . $hash[2] . $hash[3] . $hash[4] . $hash[5] . md5($user_code));
    }
    
    /**
     * Compares an inputted password with the one in the database
     * @param string $input_password - The input password
     * @param string $real_password  - The user's real password
     * @param string $user_code      - The user's activation code
     * @return true if they match, false if not
     */
    function compare_passwords($input_password, $real_password, $user_code)
    {
        // Generate the hash to compare them
        $input_hash = $this->generate_password_hash($input_password, $user_code);
        // Actually compare them
        if ($input_hash == $real_password) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Tries to login the user
     * @return true on success, false on failure
     */
    function login_user()
    {
        $username  = $_POST['username'];
        $password  = $_POST['password'];
        $remember  = $_POST['remember'];
        $user_info = $this->fetch_user_info($username);
        if ($user_info['id'] != '') {
            if ($user_info['tries'] < $this->qls->config['max_tries']) {
                if ($this->compare_passwords($password, $user_info['password'], $user_info['code'])) {
                    if ($user_info['blocked'] == 'no') {
                        // They need to be active
                        if ($user_info['active'] == 'yes') {
                            if ($remember == '1') {
                                $this->qls->Session->create_session($username, $password, $user_info['password'], true);
                            } else {
                                $this->qls->Session->create_session($username, $password, $user_info['password'], false);
                            }
                            
                            return true;
                        } else {
                            $error = "odobren";
							header( 'Location: '.$site.'/login/'.$error );
                            return false;
                        }
                    } else {
                        $this->update_tries($username, $user_info['tries']);
                        $error = "block";
						header( 'Location: '.$site.'/login/'.$error );
                        return false;
                    }
                } else {
                    $this->update_tries($username, $user_info['tries']);
                    $error = "pw";
					header( 'Location: '.$site.'/login/'.$error );
                    return false;
                }
            } else {
                $error = "pokusaj";
				header( 'Location: '.$site.'/login/'.$error );
                return false;
            }
        } else {
            $error = "popuniti";
			header( 'Location: '.$site.'/login/'.$error );
            return false;
        }
    }
    
    /**
     * Removes set logout cookies/sessions
     * @returns void but will redirect or output an error
     */
    function logout_user()
    {
        $session_names = array(
            'user_id',
            'user_time',
            'user_unique'
        );
        if (isset($_SESSION[$this->qls->config['cookie_prefix'] . 'user_unique'])) {
            $this->qls->SQL->delete('sessions', array(
                'id' => array(
                    '=',
                    $_SESSION[$this->qls->config['cookie_prefix'] . 'user_unique']
                )
            ));
        }
        
        // Remove all session information and unset the cookie
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        
        if (isset($_COOKIE[$this->qls->config['cookie_prefix'] . 'user_id'])) {
            foreach ($session_names as $value) {
                setcookie($this->qls->config['cookie_prefix'] . $value, 0, time() - 3600, $this->qls->config['cookie_path'], $this->qls->config['cookie_domain']);
            }
        }
        
        $this->qls->redirect($this->qls->config['logout_redirect']);
    }
    
    /**
     * Checks to see if that username already exists
     * @param string $username - Username to check
     * @return true if found, false if not
     */
    function check_username_existance($username)
    {
        // Check username...
        if ($this->validate_username($username)) {
            $result = $this->qls->SQL->select('id', 'users', array(
                'username' => array(
                    '=',
                    $username
                )
            ));
            $row    = $this->qls->SQL->fetch_array($result);
            
            if ($row['id'] == '') {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
	
    function check_email_existance($username)
    {
        // Check email...
        if ($this->validate_email($username)) {
            $result = $this->qls->SQL->select('id', 'users', array(
                'email' => array(
                    '=',
                    $username
                )
            ));
            $row    = $this->qls->SQL->fetch_array($result);
            
            if ($row['id'] == '') {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
    /**
     * Generates a new activation code
     * @param string $username - The user's username
     * @param string $password - The user's password
     * @param string $email    - The user's email address
     * @return SHA1 string
     */
    function generate_activation_code($username, $password, $email)
    {
        $hash[]     = md5($username . $password . md5($email));
        $hash[]     = sha1($hash[0] . $hash[0]) . md5(sha1(sha1($email) . sha1($password)) . md5($username));
        $hash[]     = sha1(sha1(sha1(sha1(md5(md5('   	') . sha1(' 	'))) . sha1($password . $username))));
        $hash[]     = sha1($hash[0] . $hash[1] . $hash[2]) . sha1($hash[2] . $hash[0] . $hash[1]);
        $hash[]     = sha1($username);
        $hash[]     = sha1($password);
        $hash[]     = md5(md5($email) . md5($password));
        $hash_count = count($hash);
        for ($x = 0; $x < $hash_count; $x++) {
            $random_hash = rand(0, $hash_count);
            $hash[]      = sha1($hash[$x]) . sha1($password) . sha1($hash[$random_hash] . $username);
        }
        
        return sha1(sha1($hash[0] . $hash[1] . $hash[2] . $hash[3]) . sha1($hash[4] . $hash[5]) . md5($hash[6] . $hash[7] . $hash[8] . sha1($hash[9])) . $password . $email);
    }
    
    /**
     * Inserts registration data into the database
     * @param string $username - The user's username
     * @param string $password - The user's password
     * @param string $email    - The user's email address
     * @return void but will output error if found
     */
    function insert_registration_data($username, $password, $email, $country, $firstname, $lastname, $city, $phone, $street, $years, $about)
    {
        // Generate activation code
        $generated_code = $this->generate_activation_code($username, $password, $email);
        
        // All the columns that should be in the users table
        $columns = array(
            'username',
            'password',
            'code',
            'active',
            'last_login',
            'last_session',
            'blocked',
            'tries',
            'last_try',
            'email',
            'activation_time',
            'country',
            'firstname',
            'lastname',
            'city',
            'phone',
            'street',
            'years',
            'about',
            'alve'
        );
        
        // All the values that go with the columns
        $values = array(
            $username,
            $this->generate_password_hash($password, $generated_code),
            $generated_code,
            'no',
            0,
            '',
            'no',
            0,
            0,
            $email,
            0,
            $country,
            $firstname,
            $lastname,
            $city,
            $phone,
            $street,
            $years,
            $about,
            500
            
        );
      
            $activation_link = "http://alva.rs/activate/{$generated_code}/{$username}";
            
            @mail($email, ACTIVATION_SUBJECT, sprintf(ACTIVATION_BODY, $activation_link), $headers);
			
            $headers = "From: info@alva.rs \r\n";
            require("app/phpmailer/class.phpmailer.php");
			$mail = new PHPMailer(); 
			$webmaster_email = "info@alva.rs"; //Reply to this email ID
			$name= $firstname; // Recipient's name
			$mail->From = $webmaster_email;
			$mail->FromName = "Alva.rs Aktivacija";
			$mail->AddAddress($email,$name);
			$mail->AddReplyTo($webmaster_email,"Alva.rs Reset Password");
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = "Alva.rs Password reset";
			$mail->Body = $activation_link; //HTML Body
			$mail->AltBody = $activation_link; //Text Body
        $this->qls->SQL->insert('users', $columns, $values);
        
        // Check the invitation code
        $code = (isset($_GET['code']) && strlen($_GET['code']) == 40 && preg_match('/^[a-fA-F0-9]{40}$/', $_GET['code'])) ? $this->qls->Security->make_safe($_GET['code']) : false;
        if ($code !== false) {
            $this->qls->SQL->update('invitations', array(
                'used' => 1
            ), array(
                'code' => array(
                    '=',
                    $code
                )
            ));
        }
    }
    
    /**
     * This will register a user
     * @return true on success, false on error
     */
    function register_user()
    {
        // Default security
        $security_check = false;
        
        /**
         * These next lines will retrieve the necessary fields. These include username,
         * password & confirmation, email & confirmation and possibly the security image.
         */
        $username                                                                     = (isset($_POST['username']) && $this->validate_username($_POST['username'])) ? $this->qls->Security->make_safe($_POST['username']) : false;
        $password                                                                     = (isset($_POST['password']) && $this->validate_password($_POST['password'])) ? $this->qls->Security->make_safe($_POST['password']) : false;
        $country                                                                      = (isset($_POST['country']) && $this->validate_password($_POST['country'])) ? $this->qls->Security->make_safe($_POST['country']) : false;
        $firstname                                                                    = (isset($_POST['firstname']) && $this->validate_password($_POST['firstname'])) ? $this->qls->Security->make_safe($_POST['firstname']) : false;
        $lastname                                                                     = (isset($_POST['lastname']) && $this->validate_username($_POST['lastname'])) ? $this->qls->Security->make_safe($_POST['lastname']) : false;
        $city                                                                         = (isset($_POST['city']) && $this->validate_password($_POST['city'])) ? $this->qls->Security->make_safe($_POST['city']) : false;
        $phone                                                                        = (isset($_POST['phone']) && $this->validate_password($_POST['phone'])) ? $this->qls->Security->make_safe($_POST['phone']) : false;
        $about                                                                        = (isset($_POST['about']) && $this->validate_username($_POST['about'])) ? $this->qls->Security->make_safe($_POST['about']) : false;
        $street                                                                       = (isset($_POST['street']) && $this->validate_password($_POST['street'])) ? $this->qls->Security->make_safe($_POST['street']) : false;
        $years                                                                        = (isset($_POST['years']) && $this->validate_password($_POST['years'])) ? $this->qls->Security->make_safe($_POST['years']) : false;
        $confirm_password                                                             = (isset($_POST['password_c']) && $_POST['password_c'] == $password) ? true : false;
        $email                                                                        = (isset($_POST['email']) && strlen($_POST['email']) > 6 && strlen($_POST['email']) < 256 && preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i', $_POST['email'])) ? $this->qls->Security->make_safe($_POST['email']) : false;
        $confirm_email                                                                = (isset($_POST['email_c']) && $_POST['email_c'] == $email) ? true : false;
        $_SESSION[$this->qls->config['cookie_prefix'] . 'registration_username']      = $this->qls->Security->make_safe($_POST['username']);
        $_SESSION[$this->qls->config['cookie_prefix'] . 'registration_email']         = $this->qls->Security->make_safe($_POST['email']);
        $_SESSION[$this->qls->config['cookie_prefix'] . 'registration_email_confirm'] = $this->qls->Security->make_safe($_POST['email_c']);
        if ($username === false) {
            $this->register_error = REGISTER_USERNAME_ERROR;
            return false;
        }
        
        if ($this->check_username_existance($username)) {
            $this->register_error = REGISTER_USERNAME_EXISTS;
            return false;
        }
        
        if ($password === false || $confirm_password === false) {
            $this->register_error = REGISTER_PASSWORD_ERROR;
            return false;
        }
        
        if ($email === false || $confirm_email === false) {
            $this->register_error = REGISTER_EMAIL_ERROR;
            return false;
        }
        /* Thumbnail class is required */
        require('app/phpthumb/ThumbLib.inc.php');
        // Specify which directory you want to upload. It should be a subfolder where the script is present
        // We also generate a unique name for picture FILE-USERID-XXX where xxx is random number
        // The uploads folder must have writable permissions.
        $uploaddir   = 'crc/';
        $chiperovan  = md5($username);
        $uploadfile  = $uploaddir . "$chiperovan.jpg";
        $uploadfile2 = $uploaddir . "$chiperovan" . "_s.jpg";
        $thumb       = PhpThumbFactory::create("crc/none.png");
        //specify the height and width of avatar image to resize
        $thumb->resize(600, 300);
        $thumb->save($uploadfile);
        $thumb = PhpThumbFactory::create("crc/none.png");
        //specify the height and width of avatar image to resize
        $thumb->resize(29, 29);
        $thumb->save($uploadfile2);
        $this->insert_registration_data($username, $password, $email, $country, $firstname, $lastname, $city, $phone, $street, $years, $about);
        return true;
    }
    
    /**
     * Compare the code input by the user to the one in the database
     * @param string $input    - The input code
     * @param string $username - The username
     * @return true if matches, false if not
     */
    function compare_codes($input, $username)
    {
        $result = $this->qls->SQL->select('*', 'users', array(
            'username' => array(
                '=',
                $username
            )
        ));
        $row    = $this->qls->SQL->fetch_array($result);
        
        // Compare the codes
        if ($row['code'] == $input) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Tries to activate a user
     * @return true on success, false on failure
     */
    function activate_user()
    {
        // validate activation code input and user id input
        $activation_code = (isset($_GET['code']) && preg_match('/[a-fA-F0-9]{40}/', $_GET['code'])) ? $this->qls->Security->make_safe($_GET['code']) : false;
        $username        = (isset($_GET['username']) && $this->validate_username($_GET['username'])) ? $this->qls->Security->make_safe($_GET['username']) : false;
        if ($activation_code === false) {
            $this->activate_error = ACTIVATE_CODE_NOT_VALID;
            return false;
        }
        
        if ($username === false) {
            $this->activate_error = ACTIVATE_USERNAME_NOT_VALID;
            return false;
        }
        
        // Compare the codes
        if ($this->compare_codes($activation_code, $username)) {
            $this->qls->SQL->update('users', array(
                'active' => 'yes',
                'activation_time' => time()
            ), array(
                'username' => array(
                    '=',
                    $username
                )
            ));
            
            return true;
        } else {
            $this->activate_error = ACTIVATE_CODE_NOT_MATCH;
            return false;
        }
    }
}
?>