<?php
/**
 * @author Luca Moser
 * This file is used for the header on each page.
 */
?>
<style>
    <?php include 'styles/header.css'; ?>
</style>
<div id="navigation">
        <?php
        // Name, Url, Image
        $tabs = [["Home","home",""],["Ueber-Uns","ueber-uns",""],["Profile","profile",""]];

        $url =  "{$_SERVER['REQUEST_URI']}";
        $specific_tab = substr($url, strpos($url, "/") + 17);
        echo "<title>$specific_tab</title>";
        foreach ($tabs as $tab) {
            if($tab[1] == $specific_tab){
                echo "<a class='tab' id='selected' href='/ArchiveOfMyself/{$tab[1]}'>{$tab[0]}</a>";
            }
            else{
                echo "<a class='tab' href='/ArchiveOfMyself/{$tab[1]}'>{$tab[0]}</a>";
            }
        }
        ?>
</div>