<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<style>
    <?php
    include 'styles/login.css';
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
    echo "<br>";
    ?>
</head>
<body>
<div id="body">
    <?php
    session_start();
    if(isset($_SESSION['loggedInUser'])){
        echo "<script>location.href='./profile'</script>";
        die;
    }
    if(isset($_GET['error'])){
        if($_GET['error'] == "username"){
            echo "<h1>Benutzername existiert nicht!</h1>";
        }
        elseif($_GET['error'] == "password"){
            echo "<h1>Passwort Falsch!</h1>";
        }
    }
    ?>
    <div id="form">
        <form action="profile.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" id="username" placeholder="BigUsername" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" placeholder="test123" name="password" required><br>
            <br>
            <input type="submit" >
        </form>
    </div>
</div>
</body>
