<?phprequire('app/main.php');if ($qls->user_info['username'] == ''){ if ($qls->config['activation_type'] == 1) {  if ($qls->User->activate_user())  {   echo ACTIVATE_SUCCESS;  }  else  {   echo $qls->User->activate_error;  } } elseif ($qls->config['activation_type'] == 2) {  echo ACTIVATE_ADMIN_VERFICATION; } else {  echo ACTIVATE_NO_NEED; }}else{ echo ACTIVATE_ALREADY_LOGGED;}?>