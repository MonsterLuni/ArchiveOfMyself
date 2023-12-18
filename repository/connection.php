<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ArchiveOfMyself";
global $conn;
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function makeQueryFetch($queryText): array
{
    global $conn;
    $query = $conn->query($queryText);
    return $query->fetch_all();
}
function makeQuery($queryText){
    global $conn;
    $conn->query($queryText);
}