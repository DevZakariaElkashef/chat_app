<?php 
include_once "header.php"; 
if(isset($_SESSION['user_id'])){
  header('Location: users.php');
}
?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Chat App</header>
      <form action="php/signup.php" method="POST" enctype="multipart/form-data">
        <div class="error-text"></div>
        <div id="success" class="success-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" >
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" >
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" >
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" id="pass_field" name="password" placeholder="Enter new password" >
          <i class="fas fa-eye" id="show_hide"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" >
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="js/passToggle.js"></script>
  <script src="js/signup.js"></script>

</body>
</html>
