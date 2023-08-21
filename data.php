<?php
// 5 == comments, 6 == videos
function verify($commentoryear_id,$user_id,$text){
    $json = json_decode(file_get_contents("data.json"));
    if(in_array($commentoryear_id,$json[$user_id]->$text)){
        echo "<p>ALARMMMMM</p>";
        return true;
    }
    else{
        echo "<p>FEHLALARM</p>";
        $nextlvl = array_push($json[$user_id]->$text,$commentoryear_id);
        var_dump($json[$user_id]->$text);
        savejson($nextlvl);
        return false;
    }
}
function savejson($jsonArray){
    json_encode($jsonArray);
    $prettyJsonString = json_encode($jsonArray, JSON_PRETTY_PRINT);
    if (file_put_contents("data.json", $prettyJsonString)){
        echo "JSON file created successfully...";
    }
    else {
        echo "Oops! Error creating json file...";
    }
}
function add_user(){
$json = [
    [
        "username" => "MonsterLuni",
        "description" => "Ich bin eine Monsterbare Katze",
        "image" => "url/bild/.ch",
        "id" => 1,
        "liked_videos" => [],
        "liked_comments" => [],
    ]
];
savejson($json);
}