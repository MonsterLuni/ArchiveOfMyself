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
    echo "<h1>Upload</h1>";
    ?>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['loggedInUser'])){
    header("Location: http://localhost/ArchiveOfMyself/profile");
    die;
}
?>
<div id="body">
    <div id="form">
        <form action="repository/Video_Repository.php" method="post" enctype="multipart/form-data">
            <label for="title">Title</label><br>
            <input type="text" id="title" placeholder="My great Video" name="title" required><br>
            <label for="description">Description</label><br>
            <input type="text" id="description" placeholder="My great Description" name="description" required><br><br>
            <label for="video" class="fileUpload">Video</label><br>
            <input type="file" id="video" name="video" accept="video/mp4" required/><br>
            <input type="submit" >
        </form>
    </div>
</div>
</body>
