<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>

<header>
    <?php
    include "Include/header.php";
    ?>
</header>
<head>
    <title></title>
<?php
    echo "<h1>Home</h1>";
?>
</head>
<body>
<?php
if(!isset($_SESSION['loggedInUser'])){
    header("Location: http://localhost/ArchiveOfMyself/profile");
    die;
}
include "videos.php";
?>
</body>
