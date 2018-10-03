<?php
require_once 'config.php';
require_once SITE_PATH . './../includes/connectDB.php';
require_once SITE_PATH . './../includes/session.php';
include '../templates/partials/header.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "INSERT INTO users (username, password) VALUES (?, SHA(?))";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $username, $password);
    $statement->execute();
    $statement->store_result();

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful) {
        $userId = $statement->insert_id;

        $addToUserRoleQuery = "INSERT INTO users_in_roles (user_id, role_id) VALUES (?, ?)";
        $addUserToUserRoleStatement = $databaseConnection->prepare($addToUserRoleQuery);

        // TODO: Extract magic number for the 'user' role ID.
        $userRoleId = 2;
        $addUserToUserRoleStatement->bind_param('dd', $userId, $userRoleId);
        $addUserToUserRoleStatement->execute();
        $addUserToUserRoleStatement->close();

        $session->set('userid', $userId);
        $session->set('username', $username);
        header("Location: index.php");
        exit;
    } else {
        echo "Failed registration";
    }
}
include '../templates/register.php';
include '../templates/partials/footer.php';

include SITE_PATH . './../includes/closeDB.php';