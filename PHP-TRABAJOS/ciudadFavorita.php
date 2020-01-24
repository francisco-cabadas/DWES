<html>

    <?php

    if (empty($_REQUEST)) {
        ?>
        <form>
            <input type='text' name='ciudad'>
            <input type='submit' name='boton'>
        </form>

        <?php
    } else {
        $ciudad = $_REQUEST['ciudad'];
        ?>

        <a href='https://www.google.com/search?q=<?=$ciudad?>'>tu ciudad es  <?=$ciudad?> </a>

        <?php
    }
    ?>

    </html>