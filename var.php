<?php
$botToken = "INSERT_TEMPLATE";
$APILink = "https://api.telegram.org/bot".$botToken."/";

function sendMessage($chatID, $text, $parse = false, $pgprw = false,$keyboard = false){
	if(strpos($text,"audio::") !== false){
		$text = str_replace("audio::","",$text);
		$url = $GLOBALS[APILink]."sendchataction?chat_id=".$chatID."&action=record_audio";
		file_get_contents($url);
		$url = $GLOBALS[APILink].'sendvoice?chat_id='.$chatID.'&voice='.$text;
	}
	elseif(strpos($text,"sticker::") !== false){
		$text = str_replace("sticker::","",$text);
		$url = $GLOBALS[APILink]."sendsticker?chat_id=".$chatID."&sticker=".$text;
	}
	elseif(strpos($text,"photo::") !== false){
		$text = str_replace("photo::","",$text);
		$url = $GLOBALS[APILink]."sendchataction?chat_id=".$chatID."&action=upload_photo";
		file_get_contents($url);
		$url = $GLOBALS[APILink]."sendphoto?chat_id=".$chatID."&photo=".$text;
	}
	elseif(strpos($text,"doc::") !== false){
		$text = str_replace("doc::","",$text);
		$url = $GLOBALS[APILink]."sendDocument?chat_id=".$chatID."&document=".$text;
	}
    elseif(strpos($text,"video::") !== false){
		$text = str_replace("video::","",$text);
		$url = $GLOBALS[APILink]."sendVideo?chat_id=".$chatID."&video=".$text;
	}
	else{
		$url = $GLOBALS[APILink]."sendchataction?chat_id=".$chatID."&action=typing";
		file_get_contents($url);
		$url = $GLOBALS[APILink]."sendmessage?chat_id=".$chatID."&text=".urlencode($text)."&parse_mode=".$parse."&disable_web_page_preview=".$pgprw."&reply_markup=".$keyboard;
	}
	file_get_contents($url);
	MessageCount();
	return;
}
function delMessage($chatID,$mexID){
	$url = $GLOBALS[APILink]."deletemessage?chat_id=".$chatID."&message_id=".$mexID;
	file_get_contents($url);
    return;
}
function pinMessage($chatID,$mexID,$noti){
	$url = $GLOBALS[APILink]."pinChatMessage?chat_id=".$chatID."&message_id=".$mexID."&disable_notification=".$noti;
	file_get_contents($url);
	return;
}
?>