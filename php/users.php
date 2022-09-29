<?php
session_start();
require_once('config.php');

$query = "SELECT * FROM users 
WHERE id <> '{$_SESSION['user_id']}' 
ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$outgoing_id = $_SESSION['user_id']; 
$you = "";
$output = "";

if(mysqli_num_rows($result) > 0) {

  while ($user = mysqli_fetch_assoc($result)){
    $messages_query = "SELECT * FROM messages WHERE (incoming_msg_id = {$outgoing_id} OR outgoing_msg_id = {$outgoing_id}) AND (outgoing_msg_id = {$user['id']} OR incoming_msg_id = {$user['id']}) ORDER BY `id` DESC LIMIT 1";

    $messages_result = mysqli_query($conn, $messages_query);
    $messages_row    = mysqli_fetch_assoc($messages_result);
    
    if(mysqli_num_rows($messages_result) > 0){
      $message = $messages_row['msg'];
    }else{
      $message = "No Massages Yet";
    }

    
    (strlen($message) > 15) ? $message = substr($message, 0, 15).'...' : $message = $message;
    ($user['status'] == 'Offline Now') ? $offline = 'offline' : $offline = '';
    $output .= "<a href='chat.php?id={$user['id']}'>
                  <div class='content'>
                    <img src='./images/{$user['img']}' alt='{$user['fname']}'>
                    <div class='details'>
                      <span>{$user['fname']} {$user['lname']}</span>
                      <p>{$you} {$message}</p>
                    </div>
                  </div>
                  <div class='status-dot {$offline}'><i class='fas fa-circle'></i></div>
                </a>";
  }
}
else{
    $output .= "No Users Are Avilable To Chat";
}

echo $output;