<?php
require('app/main.php');
if (isset($_GET['user_id'])) {
							$user_id = htmlentities($_GET['user_id']);
							$username = stripslashes($qls->User->id_to_username($_GET['user_id']));
							}
							else {
							$user_id = $qls->User->username_to_id($_GET['username']);
							$username = htmlentities($_GET['username']);
							}

							if ($qls->Admin->activate_account()) {
							header( 'Location: '.$site.'/members.php' );
							}
							else {
							printf($qls->Admin->activate_user_error . ADMIN_ACTIVATE_USER_TRY_AGAIN, $user_id);
							}
							?>