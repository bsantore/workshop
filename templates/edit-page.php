<div id="main">

    <h1>Edit Page</h1>

    <form action="editpage.php" method="post">
        <fieldset>
            <legend>Edit Page</legend>
            <ol>
                <li>
                    <input type="hidden" id="pageId" name="pageId" value="<?php echo $pageId; ?>"/>
                    <label for="menulabel">Menu Label:</label>
                    <input type="text" name="menulabel" value="<?php echo $menulabel; ?>" id="menulabel"/>
                </li>
                <li>
                    <label for="content">Page Content:</label>
                    <textarea name="content" id="content"><?php echo $content; ?></textarea>
                </li>
            </ol>
            <input type="submit" name="submit" value="Submit"/>

            <p>
                <a href="index.php">Cancel</a>
            </p>
        </fieldset>
    </form>
</div>