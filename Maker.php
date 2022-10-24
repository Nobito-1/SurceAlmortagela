<?php 
ob_start();
$token = ""; #التوكن
define("API_KEY","$token");
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
$update = json_decode(file_get_contents('php://input'));
$acc = file_get_contents("https://apis.Almortagel.ml/v1/join/access.txt");
$message = $update->message;
$text = $message->text;
$data = $update->callback_query->data;
$name = $update->message->from->first_name;
$name2 = $update->callback_query->from->first_name;
$message_id = $message->message_id;
$message_id2 = $update->callback_query->message->message_id;
$chat_id = $message->chat->id;
$chat_id2 = $update->callback_query->message->chat->id;
$from_id = $message->from->id;
$from_id2 = $update->callback_query->message->from->id;
$username = $update->message->from->username;


if($text == "/start"){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"
- اهلا بك عزيزي { $name } .
- انا بوت اقوم بصنع بوت حمايه قنوات .
- اضغط صنع بوت واتبع الخطواط جيدا .
", 
'parse_mode'=>"markdown",'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[ 
[["text"=>"- صنع بوت .","callback_data"=>"make"],["text"=>"- حذف بوت .","callback_data"=>"delete"]],
[["text"=>"- حول .","callback_data"=>"info"]],
]])
]);
}
if($data =="home"){
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
bot('SendMessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2, 
'text'=>"
- اهلا بك عزيزي { $name2 } .
- انا بوت اقوم بصنع بوت حمايه قنوات .
- اضغط صنع بوت واتبع الخطواط جيدا .", 
'parse_mode'=>"markdown",'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[ 
[["text"=>"- اصنع بوت .","callback_data"=>"make"],["text"=>"- حذف بوت .","callback_data"=>"delete"]], # هنا نقوم بوضع الازرار
[["text"=>"- حول .","callback_data"=>"info"]],
]])
]);
unlink("do/$chat_id2.txt");
}
if($data == "info"){
bot('deletemessage',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
]);
bot('Sendphoto',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
'photo' =>"https://t.me/VR_LA",
'caption'=>"
╭──── • ◈ • ────╮
么 [SOURCE](https://t.me/AlmortagelTech)
么 [Almortagel](https://t.me/Almortagel_12)
╰──── • ◈ • ────╯
⍟ 𝚃𝙷𝙴 𝙱𝙴𝚂𝚃 𝚂𝙾𝚄𝚁𝙲𝙴 𝙾𝙽 𝚃𝙴𝙻𝙴𝙶𝚁𝙰𝙼
",
'parse_mode'=>"markdown",'disable_web_page_preview'=>true,
"reply_markup"=>json_encode([
"inline_keyboard"=>[
[["text"=>"- back .","callback_data"=>"home"]],
]])
]);
}
if($data == "make" and !file_exists("bots/$chat_id2/bot.php")){
mkdir("do");
file_put_contents("do/$chat_id2.txt","true");
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2, 
'text'=>"- ارسل توكنك .",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"- الغاء .","callback_data"=>"home"]],
]])
]);
}
$status_bot = json_decode(file_get_contents("https://api.telegram.org/bot".$text."/getMe"));
$do = file_get_contents("do/$chat_id.txt");
$file = file_get_contents("virus.txt");
$host2 = $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME'];
$host1 = str_replace("Maker.php","",$host2);
$host = $host1."bots/$chat_id/bot.php";
if($text && $do == "true" && $status_bot->ok == true){
mkdir("bots");
mkdir("bots/$chat_id");
file_get_contents("https://api.telegram.org/bot".$text."/setwebhook?url=".$host."");
$file2 = str_replace("TOKEN-ID","$text",$file);
$file3 = str_replace("USER-NAME","$username",$file2);
$file4 = str_replace("ADMIN-ID","$chat_id",$file3);
file_put_contents("bots/$chat_id/bot.php",$file4);
unlink("do/$chat_id.txt");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم صنع بوتك بنجاح .",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"- دخول البوت .",'url'=>"t.me/".$status_bot->result->username]],
[["text"=>"- رجوع .","callback_data"=>"home"]],
]])
]);
}elseif($text && $do == "true" && $status_bot->ok != true){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- عذرا التوكن غير صالح .",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"- الغاء .","callback_data"=>"home"]],
]])
]);
}
$ggett = explode("\n",file_get_contents("bots/$chat_id2/bot.php"));
$hep = $ggett[7];
$mattch = str_replace('define("API_KEY","',"",$hep);
$mattch2 = str_replace('");',"",$mattch);
$get_bot = json_decode(file_get_contents("https://api.telegram.org/bot".$mattch2."/getme"));
$get_bot1 = $get_bot->result->first_name;
$get_bot2 = $get_bot->result->username;
if($data == "delete" && file_exists("bots/$chat_id2/bot.php")){
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2, 
'text'=>"
- هل انت متاكد؟ .
",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"$get_bot1",'url'=>"t.me/$get_bot2"],["text"=>"- حذف .","callback_data"=>"delbot"]],
[["text"=>"- رجوع .","callback_data"=>"home"]],
]])
]);
}
if($data == "delbot"){
unlink("bots/$chat_id2/bot.php");
rmdir("bots/$chat_id2");
bot('editmessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2, 
'text'=>"- تم حذف البوت بنجاح .",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[["text"=>"- رجوع .","callback_data"=>"home"]],
]])
]);
}