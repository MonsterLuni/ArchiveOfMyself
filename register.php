<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<style>
    <?php
    include 'styles/register.css';
    ?>
</style>
<header>
    <?php
    include "Include/header.php";
    ?>
</header>
<head>
    <title></title>
    <?php
    echo "<h1>Register</h1>";
    ?>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['loggedInUser'])){
    header("Location: http://localhost/ArchiveOfMyself/profile");
    die;
}
?>
<div id="body">
    <div id="form">
        <form action="profile.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" placeholder="BigUsername" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" placeholder="test123" name="password" required><br>
            <label for="description">Password</label><br>
            <input type="password" id="description" placeholder="dies ist eine wundervolle beschreibung" name="description" required><br>
            <br>
            <input type="submit" >
        </form>
    </div>
</div>
</body>
