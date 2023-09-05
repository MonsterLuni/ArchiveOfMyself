<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>

    <header>
        <?php



        include "Include/header.php";
        require 'repository/User_Repository.php';
        ?>
    </header>

<?php
echo "<h1>Ueber-Uns</h1>";
add_user("Testigal","Beschreibung","bild.png")
?>