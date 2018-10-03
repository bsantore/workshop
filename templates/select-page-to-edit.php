<div id="main">
    <h2>Edit Page</h2>

    <form action="selectpagetoedit.php" method="post">
        <fieldset>
            <legend>Edit Page</legend>
            <ol>
                <li>
                    <label for="pageId">Title:</label>
                    <select id="pageId" name="pageId">
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
            <input type="submit" name="submit" value="Edit"/>
        </fieldset>
    </form>
    <br/>
    <a href="index.php">Cancel</a>
</div>