<?php
include 'var.php';

$botstatus = 1;
if($botstatus == 1){
	echo "on and working";
	$update = json_decode(file_get_contents('php://input'), TRUE);
	$message = $update["message"]["text"];
	$chat_id = $update["message"]["chat"]["id"];
    file_put_contents(esempio,file_get_contents('php://input'));
	if(strpos($message, "/example") === 0){
    	sendMessage($chat_id,"/example: restituisce un messaggio di esempio.");
    }
}
?>