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
echo "<div class='review'>
      <a onclick='send_ajax(`user`)' class='review_button_comment'>Login</a>
      <a onclick='send_ajax(`user`)' class='review_button_comment'>Register</a>
      </div>";
$user = get_user(1)[0];
if("LOG IN SUCCESFULL" == verify($user[0],"Lni476905")){
    echo "<h1>{$user[0]}</h1>
          <h2>{$user[1]}</h2>";
}
else{
    $message = verify($user[0],'HAllo');
    echo "$message";
}
?>
</div>
<script>
    function send_ajax(page) {
        let data = new FormData();
        data.append('page',page)
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                alert(this.responseText);
            }
        }
        request.open("POST", "ajax_request.php");
        request.send(data);
    }

</script>