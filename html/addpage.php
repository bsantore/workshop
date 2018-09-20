<?php
require_once 'config.php';
require_once SITE_PATH . '/includes/session.php';
require_once SITE_PATH . '/includes/connectDB.php';
include SITE_PATH . '/includes/header.php';
confirm_is_admin($session);

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
?>
<?php include '../templates/add-page.php'; ?>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include SITE_PATH . '/includes/footer.php'; ?>

