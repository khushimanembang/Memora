<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <!--link to css for frontend styling-->
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <header>
         <!--logo on the header-->
        <div class="logo">
            <h1><span>MEM</span>ora</h1>
    </div>

    <nav class="More-info">
        <ul class="nav-links">
            <li><a href="work.php">HOW IT WORKS?</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="Dev.php">DEVLOPER NOTES</a></li>
</ul>
</nav>
     
    <div class="buttons">
             <!--link to signin and signup page-->
            <a href="login.php" class="signin-btn">Sign in</a> 
            <a href="signup.php" class="signup-btn">Sign Up</a>
    </div>
</header>

<section class="hero"> <!--below header section-->
    <div class="hero-text">
        <h1>Your all-in-one productivity tool for students.</h1>
        <p>Track study time,boost focus, and stay organized.</p>
        <!--redirects to the signup page for the new users-->
        <a href="signup.php" class="get-started-btn">Get Started</a> 
    </div>

     <!--section for the website info-->
    <div class="info-section">
        <div class="info-image">
            <img src="images/student.png" alt="student illustration">
    </div>

    <div class="info-text">
        <h2>Why Choose CARDodoro?</h2>
         <p>
      With CARDodoro, you can organize your study materials, track time,
      and boost focus with proven methods like Pomodoro.
    </p>
    <p>
      Stay motivated and reach your academic goals faster.
    </p>
  </div>
</div>
</section>

 <!--displays feautres of the website-->
<section class="features">
     <h2>Our Features</h2> 

      <!--used for displaying feautre box-->
     <div class="feature-container">
        <!--feature box for pomodoro-->
        <div class="feature-box"> 
            <img src="images/timer.png" alt="pomodoro timer">
            <h3>Pomodoro Timer</h3> 
            <p>Boost your focus with our integrated Pomodoro timer.</p>
        </div>
     <!--feature box for flashcards-->
        <div class="feature-box">
            <img src="images/flashcards.png" alt="flashcards"> 
            <h3>Flashcards</h3>
            <p>Enhance your memory with customizable flashcards.</p>
    </div>
  </div>
</section>
    </body>
</html>