<?php
define('DB_NAME', 'phpstorm');
define('DB_USER', 'phpstorm');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');

define('DEFAULT_ADMIN_USERNAME', 'admin');
define('DEFAULT_ADMIN_PASSWORD', 'admin');

define('SITE_TITLE', 'PHP Philly CMS');
if (!defined('SITE_PATH')) {
    define('SITE_PATH', dirname(realpath(__FILE__)));

    set_include_path(get_include_path() . PATH_SEPARATOR . SITE_PATH);
}

require_once SITE_PATH . './../includes/session.php';
require_once SITE_PATH . './../includes/connectDB.php';
