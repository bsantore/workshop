<?php
require_once 'bootstrap.php';

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

$pageid = '';
$menulabel = null;
$content = null;

if (isset($_GET['pageid'])) {
    $pageid =  $_GET['pageid'];
}

if ($pageid == 0 || $pageid == '') {
    $pageid = 1;
}

$query = 'SELECT menulabel, content FROM pages WHERE id = ? LIMIT 1';
$statement = $databaseConnection->prepare($query);
$statement->bind_param('s', $pageid);
$statement->execute();
$statement->store_result();

if ($statement->error) {
    die('Database query failed: ' . $statement->error);
}


if ($statement->num_rows == 1) {
    $statement->bind_result($menulabel, $content);
    $statement->fetch();
}

$template = $twig->load('index.twig');

print $template->render(
    [
        'SITE_NAME' => 'THIS IS THE SITE NAME',
        'MENU_LABEL' => $menulabel,
        'CONTENT' => $content,
    ]
);

include '../src/closeDB.php';
