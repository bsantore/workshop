<?php
require_once 'bootstrap.php';

confirm_is_admin($session);

include '../templates/partials/header.php';

$pageId = null;
$menulabel = null;
$content = null;
if (isset($_GET['id'])) {
    $pageId = $_GET['id'];
    $query = "SELECT menulabel, content FROM pages WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $pageId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error) {
        die('Database query failed: ' . $statement->error);
    }

    $pageExists = $statement->num_rows == 1;
    if ($pageExists) {
        $statement->bind_result($menulabel, $content);
        $statement->fetch();
    } else {
        header("Location: index.php");
        exit;
    }
} else if (isset($_POST['submit'])) {
    $pageId = $_POST['pageId'];
    $menulabel = $_POST['menulabel'];
    $content = $_POST['content'];
    $query = "UPDATE pages SET menulabel = ?, content = ? WHERE Id = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssd', $menulabel, $content, $pageId);
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
        echo 'Failed to edit page';
    }
} else {
    header("Location: index.php");
    exit;
}

include '../templates/edit-page.php';
include '../templates/partials/footer.php';

include SITE_PATH . './../includes/closeDB.php';