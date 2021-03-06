<?php include"db.php"; ?>
<?php include"includes/navbar.php"; ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $login_email = test_input($_POST["email"]);
    $login_pass = test_input($_POST["password"]);

    //Encrypting the password provided by the user
    $hash = "$2a$10$";
    $string = "iamacomputersciencestudent";
    $hashString = $hash . $string;
    $login_pass = crypt($login_pass , $hashString);

  //Fetching the email entered by user from the Db
    $query = "SELECT email FROM users WHERE email='$login_email'";
    $email_results = mysqli_query($connection , $query);
    $email_row = mysqli_fetch_assoc($email_results);

     //Checking if the email fetched exists 
    if($email_row){

        //Fetching the password from the Db
        $query = "SELECT password FROM users WHERE password='$login_pass'";
        $pass_results = mysqli_query($connection , $query);
        $pass_row = mysqli_fetch_assoc($pass_results);

        //Checking if the entered password matches the one in the Db
        if($pass_row){
            echo "Login Successful";
        }else{
            echo "Password is wrong";
        }
   
    }else{
        echo "User does not exist";
    }
 

}


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
    //Preventing mysql injection
   $data = mysqli_real_escape_string( $connection , $data);
  return $data;

}
?>

<div class="card  sign" style=" background-color: #023047;border-radius: 40px;">
    <center>
      <h4>SIGN IN</h4>
    </center>

    <form action="login.php" method="post">
      <br>
      <label for="email">Email </label> <br>
      <input type="email" class="input-fields" name="email" required>
      <br><br>
      <label for="password">Password </label> <br>
      <input name="password" type="password" class="input-fields" required> <br><br>

      <input type="checkbox"><label for="rememberMe">Remember Me</label>
      <br>
      <a href="#forget" id="link" style="color:white;text-decoration: none;">Forgot Password?</a> <br><br>
      <center>
        <button class="btn  signin" type="submit">Sign in</button>

        <br><br><br>
        <a href="register.php" style="color:white;text-decoration: none;">
          Don't have an account? Sign Up
        </a>
      </center>
    </form>
  </div>
  <!-- <footer class="container-fluid"></footer> -->

  <script src="scripts/bootstrap.min.js"></script>
  <script src="scripts/jquery.js"></script>
</body>

</html>