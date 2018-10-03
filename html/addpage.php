<?php
require_once 'bootstrap.php';

confirm_is_admin($session);

include '../templates/partials/header.php';

if (isset($_POST['submit'])) {
    $menulabel = $_POST['menulabel'];
    $content = $_POST['content'];
    $query = "INSERT INTO pages (menulabel, content) VALUES (?, ?)";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $menulabel, $content);
    $statement->execute();
    $statement->store_result();

    if ($statement->error) {
        die('Database query failed: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful) {
        header("Location: index.php");
        exit;
    } else {
        echo 'Failed adding new page';
    }
}

include '../templates/add-page.php';
include '../templates/partials/footer.php';

include SITE_PATH . './../includes/closeDB.php';