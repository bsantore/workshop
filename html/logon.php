<?php
require_once 'config.php';
require_once SITE_PATH . '/includes/session.php';
require_once SITE_PATH . '/includes/connectDB.php';
include SITE_PATH . '/includes/header.php';

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
?>
    <div id="main">
        <h2>Log on</h2>

        <form action="logon.php" method="post">
            <fieldset>
                <legend>Log on</legend>
                <ol>
                    <li>
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="" id="username"/>
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" value="" id="password"/>
                    </li>
                </ol>
                <input type="submit" name="submit" value="Submit"/>

                <p>
                    <a href="index.php">Cancel</a>
                </p>
            </fieldset>
        </form>
    </div>

<?php include SITE_PATH . '/includes/footer.php'; ?>
