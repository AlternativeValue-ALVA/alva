<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;
}

/**
 * Contains all necessary security functions
 */
class Security {

/**
 * @var object $qls - Will contain everything else
 */
var $qls;

	/**
	 * Construct class and clean input
	 * @param object $qls - Contains all other classes
	 * @return void
	 */
	function Security(&$qls) {

	$this->qls = &$qls;

		// Get rid of the slashes if it's turned on
		if (get_magic_quotes_gpc()) {
			// POST Method
			foreach ($_POST as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
						if (is_array($value2)) {
							foreach ($value2 as $key3 => $value3) {
								if (is_array($value3)) {
									foreach ($value3 as $key4 => $value4) {
										// Can't go any deeper
										if (is_array($value4)) {
										$_POST[$key][$key2][$key3][$key4] = $value4;
										}
										else {
										$_POST[$key][$key2][$key3][$key4] = stripslashes($value4);
										}
									}
								}
								else {
								$_POST[$key][$key2][$key3] = stripslashes($value3);
								}
							}
						}
						else {
						$_POST[$key][$key2] = stripslashes($value2);
						}
					}
				}
				else {
				$_POST[$key] = stripslashes($value);
				}
			}

			// GET Method
			foreach ($_GET as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
						if (is_array($value2)) {
							foreach ($value2 as $key3 => $value3) {
								if (is_array($value3)) {
									foreach ($value3 as $key4 => $value4) {
										// Can't go any deeper
										if (is_array($value4)) {
										$_GET[$key][$key2][$key3][$key4] = $value4;
										}
										else {
										$_GET[$key][$key2][$key3][$key4] = stripslashes($value4);
										}
									}
								}
								else {
								$_GET[$key][$key2][$key3] = stripslashes($value3);
								}
							}
						}
						else {
						$_GET[$key][$key2] = stripslashes($value2);
						}
					}
				}
				else {
				$_GET[$key] = stripslashes($value);
				}
			}

			// COOKIE Method
			foreach ($_COOKIE as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
						if (is_array($value2)) {
							foreach ($value2 as $key3 => $value3) {
								if (is_array($value3)) {
									foreach ($value3 as $key4 => $value4) {
										// Can't go any deeper
										if (is_array($value4)) {
										$_COOKIE[$key][$key2][$key3][$key4] = $value4;
										}
										else {
										$_COOKIE[$key][$key2][$key3][$key4] = stripslashes($value4);
										}
									}
								}
								else {
								$_COOKIE[$key][$key2][$key3] = stripslashes($value3);
								}
							}
						}
						else {
						$_COOKIE[$key][$key2] = stripslashes($value2);
						}
					}
				}
				else {
				$_COOKIE[$key] = stripslashes($value);
				}
			}
		}
	}

	/**
	 * Quotes strings for insertion in database
	 * @param    mixed $input - Can be an array of values or just a string
	 * @optional bool  $html  - Whether or not to use htmlentities()
	 * @return string of cleaned input
	 */
	function make_safe($input, $html = true) {
		if (is_array($input)) {
			/**
			 * Loops to a depth of 3, and it will add slashes to each of
			 * the $value{num} at each depth. If the htmlentities() is chosen
			 * via the $html variable, it will be used.
			 */
			foreach ($input as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
						if (is_array($value2)) {
							foreach ($value2 as $key3 => $value3) {
								if (is_array($value3)) {
									foreach ($value3 as $key4 => $value4) {
										if ($html === false) {
										$input[$key][$key2][$key3][$key4] = addslashes($value4);
										}
										else {
										$input[$key][$key2][$key3][$key4] = htmlentities($value4, ENT_QUOTES);
										}
									}
								}
								else {
									if ($html === false) {
									$input[$key][$key2][$key3] = addslashes($value3);
									}
									else {
									$input[$key][$key2][$key3] = htmlentities($value3, ENT_QUOTES);
									}
								}
							}
						}
						else {
							if ($html === false) {
							$input[$key][$key2] = addslashes($value2);
							}
							else {
							$input[$key][$key2] = htmlentities($value2, ENT_QUOTES);
							}
						}
					}
				}
				else {
					if ($html === false) {
					$input[$key] = addslashes($value);
					}
					else {
					$input[$key] = htmlentities($value, ENT_QUOTES);
					}
				}
			}

		return $input;
		}
		else {
			if ($html === false) {
			return addslashes($input);
			}
			else {
			return htmlentities($input, ENT_QUOTES);
			}
		}
	}
	/**
	 * Remove any old login attempts from the database
	 * @return void but outputs error if found
	 */
	function remove_old_tries() {
	// Find the time minus 12 hours
	$time_minus_12_hours = time() - ((60 * 60) * 12);
	$this->qls->SQL->update('users',
		array(
			'tries' => 0,
			'last_try' => time()
		),
		array('last_try' =>
			array(
				'<',
				$time_minus_12_hours
			)
		)
	);
	}

	/**
	 * Generates a random text string for the security image
	 * @return the text string generated
	 */
	function generate_text_string() {
	// List of characters to include on security image
	$characters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	$num_chars = rand(5, 8);
		for ($x = 0; $x < $num_chars; $x++) {
		$real_text .= $characters[array_rand($characters)];
		}

	return $real_text;
	}

	/**
	 * Checks to see whether the registration page is available
	 * @return void, but will kill the script if not allowed
	 */
	function check_auth_registration() {
		if ($this->qls->config['auth_registration'] == 0) {
		// See if the code is set
		$code = (isset($_GET['code']) && strlen($_GET['code']) == 40 && preg_match('/^[a-fA-F0-9]{40}$/', $_GET['code'])) ? $this->make_safe($_GET['code']) : false;
		$result = $this->qls->SQL->query("SELECT `used` FROM `{$this->qls->config['sql_prefix']}invitations` WHERE `code`='{$code}'");
		$row = $this->qls->SQL->fetch_array($result);
			if ($row['used'] == 1 || $row['used'] == '') {
			die(REGISTER_CODE_INVALID);
			}
		}
	}

	/**
	 * Checks to see whether the user can access the 
	 * page and will update the hit counter.
	 * @param string $page_name - The page to check (must have extension)
	 * @return void but will kill the script if not allowed
	 */
	function check_auth_page($page_name) {
	$page_name = $this->make_safe($page_name);
	$result = $this->qls->SQL->select('*',
		'pages',
		array('name' =>
			array(
				'=',
				$page_name
			)
		)
	);
	$row = $this->qls->SQL->fetch_array($result);
	$hash = sha1($row['id']);
		if ($this->qls->user_info['auth_' . $hash] == 0) {
		die(NO_AUTHORIZATION);
		}

	// Update the hit counter
	$this->qls->SQL->update('pages',
		array('hits' => $row['hits'] + 1),
		array('id' =>
			array(
				'=',
				$row['id']
			)
		)
	);
	}
}
?>
