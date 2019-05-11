<?php
require_once 'bootstrap.php';

include '../templates/partials/header.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, username FROM users WHERE username = ? AND password = SHA(?) LIMIT 1";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $username, $password);

    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows == 1) {
        $userId = null;
        $username = null;

        $statement->bind_result($userId, $username);
        $statement->fetch();

        $session->set('userid', $userId);
        $session->set('username', $username);

        header("Location: index.php");
        exit;
    } else {
        echo "Username/password combination is incorrect.";
    }
}

include '../templates/log-on.php';
include '../templates/partials/footer.php';
include SITE_PATH . './../includes/closeDB.php';
