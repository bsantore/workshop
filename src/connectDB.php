<?php
require_once '../src/functions/database.php';

// Create database connection
$databaseConnection = new mysqli(
    getenv('DB_HOST'), 
    getenv('DB_USER'),
    getenv('DB_PASSWORD'),
    getenv('DB_NAME')
);
if ($databaseConnection->connect_error) {
    die("Database selection failed: " . $databaseConnection->connect_error);
}



// Create tables if needed.
if (!defined('IN_TEST') || IN_TEST == false) {
    prep_DB_content();
}
