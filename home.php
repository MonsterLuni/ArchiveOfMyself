<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<header>
    <?php
    include "Include/header.php";
    ?>
</header>
<head>
    <title>Home</title>
    <meta name="viewport" content="width=">
    <?php
    echo "<br>";
    echo "<br>";
    ?>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['loggedInUser'])){
    echo "<script>location.href='./profile'</script>";
    die;
}
include "videos.php";
?>
</body>
</html>

