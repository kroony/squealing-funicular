<?php
chdir("../");
include_once("bootstrap.php");
include_once("user/user.php");
include_once("user/message.php");
$user = new User();
$user = $user->load($currentUID);
		
$deleteMessage = new Message();
$deleteMessage = $deleteMessage->load($_REQUEST['MsgID']);

if($deleteMessage->ToID == $currentUID)//check user owns message
{
  $deleteMessage->Delete();
  echo "Message Deleted";
}
else
{
  echo "That message does not belong to you, you cant delete it.";
}