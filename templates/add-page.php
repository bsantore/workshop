<div id="main">
    <h2>Add Page</h2>

    <form action="addpage.php" method="post">
        <fieldset>
            <legend>Add Page</legend>
            <ol>
                <li>
                    <label for="menulabel">Menu Label:</label>
                    <input type="text" name="menulabel" value="" id="menulabel"/>
                </li>
                <li>
                    <label for="content">Page Content:</label>
                    <textarea name="content" id="content"></textarea>
                </li>
            </ol>
            <input type="submit" name="submit" value="Submit"/>

            <p>
                <a href="index.php">Cancel</a>
            </p>
        </fieldset>
    </form>
</div>