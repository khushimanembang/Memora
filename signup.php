<!--backend for signup.php-->

<?php
include 'db.php';               // Database connection
session_start();

$check = "";                    // Will store message

$conn = new mysqli("localhost", "root", "", "productivity");        //connect to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);              //if connection fails, shows error message
}

if (isset($_POST['signup'])) {                  //check if the signup button is clicked
    $name = trim($_POST['name'] ?? '');         //fetches named entered by the user
    $email = trim($_POST['email'] ?? '');       //fetches email entered by the user
    $password_raw = $_POST['password'] ?? '';   //fetches password entered by the user

    if (empty($name) || empty($email) || empty($password_raw)) {
        $check = "All fields are required!";                          //check if the fields are empty, if it is shows error message
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?"); //if not, prepared statement to get id of the user whose email matches with the value
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);                    //check if the prepare() is failed, if it is shows the error
        }
        $stmt->bind_param("s", $email);                               //if not it puts email into the query
        $stmt->execute();                                             //it executes the statement
        $stmt->store_result();                                        //it store the results for later usage

        if ($stmt->num_rows > 0) {                                    //check if user with that email exist
            $check = "Email already registered. Please login.";       //if it does, show this message
        } else {
            $stmt->close();                                           //if not close the statement
            $password = $password_raw; //
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)"); //creates perpared statement to insert info of new user into users table
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);                                           //if prepare() fails, shows error message
            }
            $stmt->bind_param("sss", $name, $email, $password);                                   //if not it puts the name, email and pass into query

            if ($stmt->execute()) {                                     //statment is executed
                  //once it is executed, redirects to the login page
                header("Location: login.php");
                exit();                                                 //make sure to exit the code after the redirection
            } else {
                $check = "Error: " . $stmt->error;                       //check if there is any error
            }
        }
        $stmt->close();//close the statement
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
    <div class="login-image">                <!--divsion for the login picture-->
        <img src="images/login.png" alt="login illustration">
</div>
    <div class="signup-box"> 
     <h2>CREATE ACCOUNT</h2>                <!--Title on top of  the signup box-->
     
    <!-- Display message -->
    <?php
    if($check != "") {                               //check if the variable $check is empty
        echo "<p style='color:red;'>$check</p>";    //if it is not, then it displays the value on red color
    }
    ?>
     <form action="" method="post">                  <!--post to send the data safely to the server-->
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <button type="submit" name="signup">Create</button>
    </form>
    <p class="login">Already have an account? <a href="login.php">Log in</a></p><!--link to login.php if the user has already registered-->
   </div>
    </section>
</body>
</html>
