<?php
if (!defined('QUADODO_IN_SYSTEM')) {
exit;
}

define('SYSTEM_INSTALLED', true);
$database_prefix = 'qls3_';
$database_type = 'MySQL';
$database_server_name = 'localhost';
$database_username = '#';
$database_password = '#';
$database_name = '#';
$database_port = false;

/**
 * Use persistent connections?
 * Change to true if you have a high load
 * on your server, but it's not really needed.
 */
$database_persistent = false;
?>