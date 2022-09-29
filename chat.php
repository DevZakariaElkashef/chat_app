<?php
include_once "header.php"; 

$user_id = mysqli_real_escape_string($conn, $_GET['id']);
$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE id = {$_SESSION['user_id']}");
if(mysqli_num_rows($sql2) <= 0){
  header('location: php/logout.php');
}

if(isset($_SESSION['user_id'])){
  
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$user_id}'" );
  $row = mysqli_fetch_assoc($sql);
 
 
 }
else{
  header('Location: login.php');
}
?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="images/<?= $row['img']?>" alt="">
        <div class="details">
          <span><?= $row['fname'] ." ". $row['lname']?></span>
          <p><?= $row['status']?></p>
        </div>
      </header>
      <div class="chat-box">
       
        
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="outgoing_id" name="outgoing_id" value="<?= $_SESSION['user_id']?>" hidden>
        <input type="text" class="incoming_id" name="incoming_id" value="<?= $user_id?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>


  <script src="js/chat.js"></script>
</body>
</html>
