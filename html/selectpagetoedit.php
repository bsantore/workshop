<?php
require_once 'config.php';

confirm_is_admin($session);
include '../templates/partials/header.php';

if (isset($_POST['submit'])) {
    $pageId = $_POST['pageId'];
    $query = "SELECT Id FROM pages WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $pageId);
    $statement->execute();
    $statement->store_result();

    if ($statement->error) {
        die('Database query failed: ' . $statement->error);
    }

    // TODO: Check for == 1 instead of > 0 when page names become unique.
    $pageExists = $statement->num_rows == 1;
    if ($pageExists) {
        header("Location: editpage.php?id=$pageId");
    } else {
        echo "Failed to locate selected page for edit";
    }
}
include '../templates/select-page-to-edit.php';
include '../templates/partials/footer.php';

include SITE_PATH . './../includes/closeDB.php';
