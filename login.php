<!--backend part for login form-->
<?php
//start session to store user info
session_start(); 
 //database connection
require 'db.php';
/*echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;*/

    //it connects to the database
   $conn= new mysqli("localhost","root","","productivity");     
   if($conn->connect_error){
       die("Connection failed: ". $conn->connect_error);    //if connection fail, it shows error message
   }
   //store error/success message
   $check="";   

    //checks if login button is clicked 
   if(isset($_POST['login'])){    
       //if it is clicked, it fetches email and pssword entered by the user        
       $email =trim( $_POST['email']);    
       $password= $_POST['password'];    

       //prepare sql to prevent sql injection
       //statement to get id, name ,email and pass form the users table where the email matches the value
       $stmt= $conn->prepare("SELECT id, name, email, password FROM users WHERE email=?");  
       //"s" means string...puts the email into the query
       $stmt->bind_param("s",$email);                                                     
       $stmt->execute();                                                              
       $stmt->store_result();                                                             

     //checks if query returned any rows (i.e.  a user with the entered email exist)
       if($stmt->num_rows>0){ 
        //It links the column from the result to the PHP variables                                
        $stmt->bind_result($id,$name,$db_email,$db_password); 
        //grabs the actual value of id, name, email and pass into PHP variables
        $stmt->fetch();                                       

        if($password===$db_password){
            //password correct ->redirect to homepage
             //it stores user id,username,email in session variable
             $_SESSION['user_id'] = $id;           
            $_SESSION['user_name'] = $name;       
            $_SESSION['user_email'] = $db_email; 
            header("Location:dashboard.php");  
            //ensure no further code is executed after the code is redirected 
            exit();                             
       }else{
        $check="Incorrect password.";      
       }
    }else{
        //stores error message if email not found
        $check="No user found with this email."; 

    }
     //close statement
    $stmt->close();
   }
    //disconnect from server/ database
    $conn->close();
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
<body >
    <header>
        <div class="logo">
            <h1><span>MEM</span>ora</h1>
    </div>
</header>
  <section class=login>
    <div class="login-image">
        <img src="images/login.png" alt="illustration of login">
</div>
    <div class="login-box">
     <h2>LOG IN</h2>
      <p><i>Stay focused.Stay Connected.</i></p>
        <!-- Show message if email/password incorrect -->
        <?php
         if($check != "") { 
            echo "<p style='color:red;'>$check</p>";
             } 
        ?>

<!--POST method sends the data safely-->
     <form action="" method="post"> 
        <!--it ensures that the email,password is entered-->
        <input type="email" name="email" placeholder="Email" required><br> 
        <input type="password" name="password" placeholder="password" required><br>
        <!--SUbmit button to login-->
        <button type="submit" name="login">Log in</button> 
    </form>

<!--it refers to signup.php for new users-->
    <p class="signup">New here? <a href="signup.php">Sign up</a></p> 
   </div>
    </section>
    
</body>
</html>