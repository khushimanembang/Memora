<!--backend for signup.php-->

<?php
include 'db.php';
  // Database connection             
session_start();

   // Will store message
$check = "";                 

$conn = new mysqli("localhost", "root", "", "productivity");      
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);              
}

//check if the signup button is clicked
if (isset($_POST['signup'])) {      
     //fetches named,email & password entered by the user            
    $name = trim($_POST['name'] ?? '');        
    $email = trim($_POST['email'] ?? '');     
    $password_raw = $_POST['password'] ?? '';   

     //check if the fields are empty, if it is shows error message
    if (empty($name) || empty($email) || empty($password_raw)) {
        $check = "All fields are required!";                         
    } else {
        //if not, prepared statement to get id of the user whose email matches with the value
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?"); 
        //check if the prepare() is failed, if it is shows the error
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);                    
        }
        $stmt->bind_param("s", $email);                               
        $stmt->execute();                                             
        $stmt->store_result();                                       

        if ($stmt->num_rows > 0) {  
            //check if user with that email exist                                  
            $check = "Email already registered. Please login."; //if it does, show this message
        } else {
            $stmt->close();                                          
            $password = $password_raw; //
            //creates perpared statement to insert info of new user into users table
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)"); 
            if (!$stmt) {
                 //if prepare() fails, shows error message
                die("Prepare failed: " . $conn->error);                                          
            }
            //if not it puts the name, email and pass into query
            $stmt->bind_param("sss", $name, $email, $password);                                   

            if ($stmt->execute()) {                                  
                  //once it is executed, redirects to the login page
                header("Location: login.php");
                  //make sure to exit the code after the redirection
                exit();                                               
            } else {
                $check = "Error: " . $stmt->error;                     
            }
        }
        $stmt->close();
    }
}


?>

<!--html for signup.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1><span>MEM</span>ora</h1>
    </div>
</header>
  <section class=signup>
     <!--divsion for the login picture-->
    <div class="login-image">               
        <img src="images/login.png" alt="login illustration">
</div>
    <div class="signup-box"> 
     <h2>CREATE ACCOUNT</h2>             
     
    <!-- Display message -->
    <?php
    //check if the variable $check is empty
    if($check != "") {                               
        echo "<p style='color:red;'>$check</p>";    //if it is not, then it displays the value on red color
    }
    ?>

    <!--post to send the data safely to the server-->
     <form action="" method="post">            
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <button type="submit" name="signup">Create</button>
    </form>
   
    <p class="login">Already have an account? <a href="login.php">Log in</a>
             <!--link to login.php if the user has already registered-->
        </p>
   </div>
    </section>
</body>
</html>
