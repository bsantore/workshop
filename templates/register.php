<div id="main">
    <h2>Register an account</h2>

    <form action="register.php" method="post">
        <fieldset>
            <legend>Register an account</legend>
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