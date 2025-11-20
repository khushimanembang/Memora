<!--backend part for login form-->
<?php
session_start(); //start session to store user info
require 'db.php'; //database connection
/*echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;*/


   $conn= new mysqli("localhost","root","","productivity");     //it connects to the database
   if($conn->connect_error){
       die("Connection failed: ". $conn->connect_error);        //if connection fail, it shows error message
   }
   $check="";   //store error/success message

   if(isset($_POST['login'])){             //checks if login button is clicked 
       $email =trim( $_POST['email']);    //if it is clicked, it fetches email entered by the user
       $password= $_POST['password'];    //it fetches password entered by the user

       //prepare sql to prevent sql injection
       $stmt= $conn->prepare("SELECT id, name, email, password FROM users WHERE email=?");  //statement to get id, name ,email and pass form the users table where the email matches the value
       $stmt->bind_param("s",$email);                                                       //"s" means string...puts the email into the query
       $stmt->execute();                                                                   //executes the prepared SQL statement
       $stmt->store_result();                                                              //it saves the query results for later usage

       if($stmt->num_rows>0){                                  //checks if query returned any rows (i.e.  a user with the entered email exist)
        $stmt->bind_result($id,$name,$db_email,$db_password); //It links the column from the result to the PHP variables
        $stmt->fetch();                                       //grabs the actual value of id, name, email and pass into PHP variables

        if($password===$db_password){
            //password correct ->redirect to homepage
             $_SESSION['user_id'] = $id;            //it stores user id in session variable
            $_SESSION['user_name'] = $name;        //stores username in session variable
            $_SESSION['user_email'] = $db_email;  //stores user email in session variable
            header("Location:dashboard.php");    //once it is stored, it redirects to dashboard.php
            exit();                             //ensure no further code is executed after the code is redirected
       }else{
        $check="Incorrect password.";          //Check variable stores the error message if password is incorrect
       }
    }else{
        $check="No user found with this email."; //stores error message if email not found

    }
    $stmt->close(); //close statement
   }
    $conn->close(); //disconnect from server/ database
?>
<!--html part for login form-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1><span>CARD</span>odoro</h1>
    </div>
</header>
  <section class=login>
    <div class="login-image">
        <img src="images/login.png" alt="illustration of login">
</div>
    <div class="login-box">
     <h2>LOG IN</h2>
        <!-- Show message if email/password incorrect -->
        <?php
         if($check != "") { 
            echo "<p style='color:red;'>$check</p>";
             } 
        ?>

     <form action="" method="post"> <!--POST method sends the data safely-->
        <input type="email" name="email" placeholder="Email" required><br> <!--it ensures that the email is entered-->
        <input type="password" name="password" placeholder="password" required><br><!--Ensure the password is entered-->
        <button type="submit" name="login">Log in</button> <!--SUbmit button to login-->
    </form>
    <p class="signup">New here? <a href="signup.php">Sign up</a></p> <!--it refers to signup.php for new users-->
   </div>
    </section>
    
</body>
</html>