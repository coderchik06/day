<?php
ob_start();
define('API_KEY','847003008:AAHdXVO4IMZEdazZmNV5LxQiYnqbImm4GJA');
$admin = "621617473";
$kanali = "@Dil_sozlarm";
$mybot="@DaySandBox_robot";
$Botuser="@DaySandBox_robot";

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
$efede = json_decode(file_get_contents('php://input'), true);
$message = $update->message;

$text1 = $message->text;
$text = $message->text;
$photo = $update->message->photo;
$gif = $update->message->animation;
$video = $update->message->video;
$music = $update->message->audio;
$voice = $update->message->voice;
$sticker = $update->message->sticker;
$document = $update->message->document;
$caption = $message->caption;
$capt = $update->message->caption;
$forward_ch = $message->forward_from_chat;
$forward = $update->message->forward_from;

//group
$ctitle = $update->message->chat->title;
$chat_id = $message->chat->id;
$cid = $update->message->chat->id;

//user
$name = $update->message->from->first_name;
$uname = $update->message->from->last_name;
$ulogin = $update->message->from->username;
$user_id = $update->message->from->id;
$new_chat_members = $message->new_chat_member->id;

$mid = $message->message_id;
$forid = $update->message->forward_from->message_id;
$forward = $update->message->forward_from;
$from_id = $message->from->id;

//bu yerni o'zgartirishingiz mumkin.

$from = $message->from;
$mid = $update->message->message_id;
$cty = $message->chat->type;

//Yangi odam id si
$new_user = $message->new_chat_member;
$new_user_id= $message->new_chat_member->id;
$new_fname= $message->new_chat_member->first_name;
$username = $message->from->username;
$fname= $message->from->first_name;
$is_bot = $message->new_chat_member->is_bot;
$step = file_get_contents("stat/$chat_id.step");


     $gett = bot('getChatMember', [
     'chat_id' => $chat_id,
     'user_id' => $user_id,
     ]);
     $get = $gett->result->status;
     
     $mem = bot('getChatMembersCount',[
'chat_id'=>$cid,
]);
$azo = $mem->result;
     
     

//<---------------START IN----------------->
if($cty=="private"){
if((mb_stripos($text,"/start")!==false) or ($text) ){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"👋*Salom, $name!*
Man *arablarni, reklamalani, ssilkalarini* guruhlarda o'chirib beraman👨🏻‍✈ 

Man ishlashim uchun *guruhizga* qo'shib *admin* berishiz kerak😄

*⭕️Bot guruhingizda 24 soat xizmatda bõladi!*",
        'parse_mode'=>'markdown',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[['text'=>'👥Guruhga qo‘shish🔀','url'=>"telegram.me/DaySandBox_robot?startgroup=new"]],        
            ]
        ])
    ]);
}
}





if(mb_stripos($text,"/start")!==false){

   $baza=file_get_contents("stat/azo.dat");
   if(mb_stripos($baza,$chat_id) !==false){
   }else{
   $txt="\n$chat_id";
   $file=fopen("stat/azo.dat","a");
   fwrite($file,$txt);
   fclose($file);
   }
}
if($text1 == "/stat"){
      $baza=file_get_contents("stat/azo.dat");
      $all=substr_count($baza,"\n");
      $gr=substr_count($baza,"-");
      $us=$all-$gr;
      $tx = "<b>📡 Botdan foydalanayotgan
      
👥 Guruhlar: $gr ta

👤 Userlar: $us ta

🔁 Hammasi bõlib: $all ta </b>";
   bot('SendMessage',[
   'chat_id'=>$chat_id,
    'message_id'=>$mid,
    'text'=> $tx,
'parse_mode' => 'html',
]);
}



//<------------------START OUT----------------->
if(isset($message->new_chat_member) or isset($message->left_chat_member)){
    bot('deleteMessage',[
        'chat_id'=>$message->chat->id,
        'message_id'=>$message->message_id,
    ]);
}

if($new_chat_members == bot('getMe')->result->id){
    $get = bot('getChatMembersCount', ['chat_id' => $chat_id])->result;
    if ($get <= 20) {
        bot('sendMessage', [
            'chat_id' =>$chat_id,
            'text' => "Meni Guruhingizga qo'shishingiz uchun 20 kishidan koproq odam bolish kere🙁🖤",
        ]);
        bot('leaveChat', [
            'chat_id' => $chat_id
        ]);
    } else {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "🙋‍♂Salom barchaga endi men * $ctitle *guruhi uchun xizmat qilaman
🤖Meni guruhingizda himoyani boshlashim uchun* Admin *qiling!  ",
         'parse_mode' => 'markdown',
     'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Dardlarim...😔","url"=>"https://t.me/dil_sozlarm"]],
            ]
        ])
]);
    }
}



     


if(isset($forward)!==false){
if($cty == "group" or $cty == "supergroup"){
$gett = bot('getChatMember', [
'chat_id' => $chat_id,
'user_id' => $from_id,
]);
$get = $gett->result->status;
if($get =="member"){
bot ('deleteMessage', [
'chat_id'=>$chat_id,
'message_id'=> $mid,
]);
$send = bot ('SendMessage', [
'chat_id'=>$chat_id,
'text'=>"‼ <a href='tg://user?id=$from_id'>$name</a>    <b>iltimos reklama tarqatmang!</b>",
'parse_mode'=>"html",
]);}}}

if(isset($caption)!==false){
if($cty == "group" or $cty == "supergroup"){
$gett = bot('getChatMember', [
'chat_id' => $chat_id,
'user_id' => $from_id,
]);
$get = $gett->result->status;
if($get =="member"){
bot ('deleteMessage', [
'chat_id'=>$chat_id,
'message_id'=> $mid,
]);
 bot ('SendMessage', [
'chat_id'=>$chat_id,
'text'=>"‼ <a href='tg://user?id=$from_id'>$name</a>    <b>iltimos reklama tarqatmang!</b>",
'parse_mode'=>"html",
]);}}}


if((mb_stripos($text1,"http") !==false) or (stripos($text,".ru")!==false) or (stripos($text,".com")!==false) or (stripos($text1,"bot?start=")!==false) or (stripos($text1,"https://")!==false)){
if($cty == "group" or $cty == "supergroup"){
$gett = bot('getChatMember', [
'chat_id' => $chat_id,
'user_id' => $from_id,
]);
$get = $gett->result->status;
if($get =="member"){
bot ('deleteMessage', [
'chat_id'=>$chat_id,
'message_id'=> $mid,
]);
 bot ('SendMessage', [
'chat_id'=>$chat_id,
'text'=>"‼ <a href='tg://user?id=$from_id'>$name</a>    <b>iltimos reklama tarqatmang!</b>",
'parse_mode'=>"html",
]);}}}


if((mb_stripos($text1,"@") !==false) or (stripos($text,"@")!==false) or (stripos($text,"@gmail")!==false) or (stripos($text,"@")!==false)){
if($cty == "group" or $cty == "supergroup"){
$gett = bot('getChatMember', [
'chat_id' => $chat_id,
'user_id' => $from_id,
]);
$get = $gett->result->status;
if($get =="member"){
bot ('deleteMessage', [
'chat_id'=>$chat_id,
'message_id'=> $mid,
]);
bot ('SendMessage', [
'chat_id'=>$chat_id,
'text'=>"‼ <a href='tg://user?id=$from_id'>$name</a>    <b>iltimos reklama tarqatmang!</b>",
'parse_mode'=>"html",
]);}}}

if (($new_chat_members != NUll)&&($is_bot!=false)) {
$gett = bot('getChatMember', [
'chat_id' => $chat_id,
'user_id' => $from_id,
]);
$get = $gett->result->status;
if($get =="member"){
   $vaqti = strtotime("+999999999999 minutes");
  bot('kickChatMember', [
      'chat_id' => $chat_id,
      'user_id' => $new_chat_members,
      'until_date'=> $vaqti,
  ]);
 bot('sendmessage', [
      'chat_id' => $chat_id,
      'text' => "👷Guruhga faqat adminlar bot qo'shishi mumkin!",
      'parse_mode' => 'html',
  'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard' => [
[['text'=>'Kanalim❤','url'=>'https://t.me/joinchat/AAAAAETBpSWxAFjppkDCow']]
]
]),
]);
}
}

if(stristr($text,"ض") or stristr($text, 'ص') or stristr($text, 'ث') or stristr($text, 'ق') or stristr($text, 'ف') or stristr($text, 'غ') or stristr($text, 'ع') or stristr($text, 'ه') or stristr($text, 'خ') or stristr($text, 'ح') or stristr($text, 'ج') or stristr($text, 'ش') or stristr($text, 'س') or stristr($text, 'ي') or stristr($text, 'ب') or stristr($text, 'ل') or stristr($text, 'ا') or stristr($text, 'ت') or stristr($text, 'ن') or stristr($text, 'م') or stristr($text, 'ك') or stristr($text, 'ط') or stristr($text, 'ذ') or stristr($text, 'ء') or stristr($text, 'ؤ') or stristr($text, 'ر') or stristr($text, 'ى') or stristr($text, 'ئ') or stristr($text, 'ة') or stristr($text, 'و') or stristr($text, 'ز') or stristr($text, 'ظ') or stristr($text, 'د') or stristr($text, 'أ') or stristr($text, 'إ') or stristr($text, 'آ')or stristr($capt,"ض") or stristr($capt, 'ص') or stristr($capt, 'ث') or stristr($capt, 'ق') or stristr($capt, 'ف') or stristr($capt, 'غ') or stristr($capt, 'ع') or stristr($capt, 'ه') or stristr($capt, 'خ') or stristr($capt, 'ح') or stristr($capt, 'ج') or stristr($capt, 'ش') or stristr($capt, 'س') or stristr($capt, 'ي') or stristr($capt, 'ب') or stristr($capt, 'ل') or stristr($capt, 'ا') or stristr($capt, 'ت') or stristr($capt, 'ن') or stristr($capt, 'م') or stristr($capt, 'ك') or stristr($capt, 'ط') or stristr($capt, 'ذ') or stristr($capt, 'ء') or stristr($capt, 'ؤ') or stristr($capt, 'ر') or stristr($capt, 'ى') or stristr($capt, 'ئ') or stristr($capt, 'ة') or stristr($capt, 'و') or stristr($capt, 'ز') or stristr($capt, 'ظ') or stristr($capt, 'د') or stristr($capt, 'أ') or stristr($capt, 'إ') or stristr($capt, 'آ')){
bot('deletemessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid,
      ]);
   bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<a href='tg://user?id=$from_id'>$name</a> <b>Xabarida Arab Harflari Qatnashgani Uchun Xabari ochirildi</b>",
        'parse_mode'=>'html',
      ]);
  }

if($text == '/code' and $chat_id == $admin){
bot('sendDocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile(__FILE__),
'caption'=>" <b>code</b>",
'parse_mode'=>"html",
'reply_to_message_id'=>$mid,
]);
}
