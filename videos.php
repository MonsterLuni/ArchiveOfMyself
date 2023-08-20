<?php
/**
 * @author Luca Moser
 * This file is used for the body on each page.
 */
?>
<style>
    <?php include 'styles/body.css'; ?>
</style>
<div id="body">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    ?>
</div>
