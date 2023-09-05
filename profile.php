<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<style>
    <?php
    include 'styles/videos.css';
    ?>
</style>
<header>
    <?php



    include "Include/header.php";
    require 'repository/User_Repository.php';
    ?>
</header>
<div id="body">
<?php
$user = get_user(1)[0];
echo "<h1>{$user[0]}</h1>
      <h2>{$user[1]}</h2>";
?>
</div>