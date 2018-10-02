<div id="main">
    <h2>Delete Page</h2>

    <form action="deletepage.php" method="post">
        <fieldset>
            <legend>Delete Page</legend>
            <ol>
                <li>
                    <label for="menulabel">Title:</label>
                    <select id="menulabel" name="menulabel">
                        <option value="0">--Select Page--</option>
                        <?php
                        $statement = $databaseConnection->prepare("SELECT id, menulabel FROM pages");
                        $statement->execute();

                        if ($statement->error) {
                            die("Database query failed: " . $statement->error);
                        }

                        $statement->bind_result($id, $menulabel);
                        while ($statement->fetch()) {
                            echo "<option value=\"$id\">$menulabel</option>\n";
                        }
                        ?>
                    </select>
                </li>
            </ol>
            <input type="submit" name="submit" value="Delete"/>

            <p>
                <a href="index.php">Cancel</a>
            </p>
        </fieldset>
    </form>
</div>