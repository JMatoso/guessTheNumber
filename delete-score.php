<?php require_once("assets/includes/functions.php");
if(isset($_GET["id"])){
    $id = clrInput($_GET["id"], $con);
    $score = getSingleData("scores", "WHERE id = {$id}", $con);
    if($score){
        $query = "DELETE FROM scores WHERE id = {$id} LIMIT 1";
        if($con->query($query) === true){
            sendto("index.php");
        }else{
            sendto("index.php");
        }
    }else{
        sendto("index.php");
    }
}else{
    sendto("index.php");
}