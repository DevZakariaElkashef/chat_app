<?php
session_start();
require_once('config.php');

$searchTem = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$query = "SELECT * FROM users WHERE id <> '{$_SESSION['user_id']}' AND (fname LIKE '%{$searchTem}%' or lname LIKE '%{$searchTem}%')";
$result = mysqli_query($conn, $query);
$outgoing_id = $_SESSION['user_id']; 
$you = "";
$output = "";


if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
      $messages_query = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['id']}
                      OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id}
                      OR outgoing_msg_id = {$outgoing_id}) ORDER BY id DESC LIMIT 1";
    $messages_result = mysqli_query($conn, $messages_query);
    $messages_row    = mysqli_fetch_assoc($messages_result);
    if(mysqli_num_rows($messages_result) > 0){
      if($messages_row['outgoing_msg_id'] == $outgoing_id){
        $you = "You: ";
      }
      $message = $messages_row['msg'];
    }
    else{
      $message = "NO Messages Yet";
    }

    (strlen($message) > 15) ? $message = substr($message, 0, 15).'...' : $message = $message;



        $output .= "<a href='chat.php?id={$row['id']}'>
        <div class='content'>
          <img src='./images/{$row['img']}' alt='{$row['fname']}'>
          <div class='details'>
            <span>{$row['fname']} {$row['lname']}</span>
            <p>{$you} {$message}</p>
            </div>
        </div>
        <div class='status-dot'><i class='fas fa-circle'></i></div>
      </a>";
    }
}
else{
    $output .= "No Users Are Avilable To Chat";
}

echo $output;
