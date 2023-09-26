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
    echo "<script>location.href='./profile'</script>";
    die;
}
?>
<div id="body">
    <div id="form">
        <form action="repository/User_Repository.php" method="post" enctype="multipart/form-data">
            <label for="username">Username</label><br>
            <input type="text" id="username" placeholder="BigUsername" name="username" required><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" placeholder="test123" name="password" required><br>
            <label for="description">Description</label><br>
            <input type="text" id="description" placeholder="dies ist eine beschreibung" name="description" required><br><br>
            <label for="avatar" class="fileUpload">Profile Picture</label><br>
            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required/><br>
            <input type="submit" >
        </form>
    </div>
</div>
</body>
