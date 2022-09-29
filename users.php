<?php 
include_once "header.php"; 

if(isset($_SESSION['user_id'])){
  
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'" );
  $row = mysqli_fetch_assoc($sql);
  if(mysqli_num_rows($sql) <= 0 ){
    header('location:php/logout.php');
  }

 
 }
else{
  header('Location: login.php');
}
?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <?php if(isset($row)) :?>
        <div class="content">
          <img src="images/<?= $row['img']?>" alt="">
          <div class="details">
            <span><?= $row['fname'] ." ". $row['lname']?></span>
            <p><?= $row['status']?></p>
          </div>
        </div>
        <?php endif;?>
        <a href="php/logout.php" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

        

        
      </div>
    </section>
  </div>

  <script src="js/users.js"></script>
</body>
</html>
