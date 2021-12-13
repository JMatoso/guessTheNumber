<?php
$con = new mysqli("localhost", "root", "", "gtn-game");

if ($con->connect_error)
    die(include_once("bd-error.php"));

function sendto($local)
{
    header("Location: " .$local);
    exit;
}
function goodQuery($result){
    if(!$result)
        die(sendto("query-error.php?returnUrl=".$_SERVER["PHP_SELF"]."?".$_SERVER['QUERY_STRING']));
}
function getData($table, $param, $con){
    $sql = "SELECT * FROM {$table} {$param}";
    $result = $con->query($sql);
    goodQuery($result);
    return $result;
}
function getSingleData($table, $param, $con){
    $sql = "SELECT * FROM {$table} {$param}";
    $result = $con->query($sql);
    goodQuery($result);
    if ($result->num_rows > 0) {
        while($result = $result->fetch_assoc()) { 
            return $result;
        }
    }else{
        return null;
    }
}
function hyperLink($string){
    //$string = preg_replace("~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~","<a href=\"\\0\">\\0</a>", $string);
    $string = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', '<a id="new-link" target="_blank" rel="noopener noreferrer" href="\0">\0</a>', $string);
    return $string;
}
function clrInput($input, $con){
    $input = htmlspecialchars($input);
    $input = mysqli_real_escape_string($con, $input);
    $input = trim($input);
    $input = ltrim($input);
    return $input;
}
function clrOutput($input){
    $input = htmlentities($input);
    $input = html_entity_decode($input);
    $input = trim($input);
    $input = ltrim($input);
    $input = nl2br($input);
    $input = hyperLink($input);
    return $input;
}
function insertData($table, $param, $values, $con){
    $sql = "INSERT INTO {$table} ({$param}) VALUES ('{$values}')";
    if ($con->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
