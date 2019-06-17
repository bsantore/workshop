<?php
define('DEFAULT_ADMIN_USERNAME', 'admin');
define('DEFAULT_ADMIN_PASSWORD', 'admin');

define('SITE_TITLE', 'PHP Philly CMS');
if (!defined('SITE_PATH')) {
    define('SITE_PATH', dirname(realpath(__FILE__)));

    set_include_path(get_include_path() . PATH_SEPARATOR . SITE_PATH);
}

require_once '../vendor/autoload.php';

require_once '../src/classes/Session.php';
require_once '../src/connectDB.php';
