<?php include"db.php"; ?>
<?php include"includes/navbar.php"; ?>

<?php
    
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $programme = test_input($_POST["programme"]);
  $password = test_input($_POST["password"]);

  $hash = "$2a$10$";
  $string = "iamacomputersciencestudent";
  $hashString = $hash . $string;
  $password = crypt($password , $hashString);



  $query = "INSERT INTO users (username, email, programme ,password)  VALUES ('$username' , '$email' , '$programme' , '$password')"; 

  $insertingData = mysqli_query($connection , $query);

  if(!$insertingData){
      echo "Inserting data to the Db failed";
  } else{
    echo '<script type="text/javascript">alert("Registration Successful!");</script>'; 
    header("Location:login.php");
  }

 }

 function test_input($data){
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;

     //Preventing mysql injection
    $data = mysqli_real_escape_string($connection, $data);
   return $data;

 }

?>


<script type = "text/javascript">
    
    function validate() {
    if( form.username.value == "" ) {
          alert( "Please provide your Username!" );
          document.form.username.focus();
          return false;
       }
   var regex = /^[a-zA-Z]+$/;
    if(regex.test(form.username.value) == false){
      alert("Username must be in alphabets only");
      document.form.username.focus()
      return false;
   }
 //   if(password.length  &&  confirmPassword.length < 8) {  
 //     alert("Password length must be atleast 8 characters");  
 //     document.form.password.focus()
    
 // }  

  var pass = document.getElementById("password").value;
  var pass1= document.getElementById("confirmPassword").value;
     
     if(pass != pass1){
      alert("Passwords do not match");
      return false;
    }
    
       return( true );
   
}
</script>  


 <div id="register-div">
   <div class="card  sign" style=" background-color: #023047;border-radius: 40px;">
     <center>
       <h4>REGISTER</h4>
     </center>
 
     <form action="register.php" method="post" name=form onsubmit = return(validate());>
       
       <label for="username">Username </label> <br>
       <input type="text" name="username" class="input-fields" required>
       <br><br>
       <label for="email">Email </label> <br>
       <input type="email" name="email" class="input-fields" required> <br><br>
       
       <label for="programme">Programme </label> <br> <br>
       
       <select name="programme" class="input-fields">
         <option value="Bsc. in CS">Bsc in Computer science</option>
         <option value="BSc. BIT">Bsc in  Business Information Technology</option>
         <option value="BSc. TE">Bsc in Telecommunications Engineering</option>
         <option value="BSc. EE">Bsc in Electronics Engineering</option>
         <option value="BSc. CE">Bsc in Computer Engineering</option>
       </select><br><br>
 
       <label for="password">Password </label> <br>
       <input type="password" name="password" id="password" class="input-fields" min=8 required>
       <br><br>
 
       <label for="username">Confirm password </label> <br>
       <input type="password" name="confirmPassword" id="confirmPassword" class="input-fields" required>
       <br><br>
 
 
       <center>
         <button class="btn register" type="submit">REGISTER</button>
 
         <br><br><br>
         <a href="login.php" style="color:white;text-decoration: none;">
           Already have an account? Sign In
         </a>
       </center>
     </form>
   </div>
 </div>

 
 <!-- <footer class="container-fluid"></footer> -->

 <script src="scripts/bootstrap.min.js"></script>
 <script src="scripts/jquery.js"></script>
</body>

</html>