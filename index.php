<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link rel="stylesheet" href="style.css"> <!--link to css for frontend styling-->
</head>
<body>
    <header>
        <div class="logo">
            <h1><span>CARD</span>odoro</h1> <!--logo on the header-->
    </div>
    <div class="buttons">
            <a href="login.php" class="signin-btn">Sign in</a> <!--link to signin page-->
            <a href="signup.php" class="signup-btn">Sign Up</a><!--link to signup page-->
    </div>
</header>
<section class="hero"> <!--below header section-->
    <div class="hero-text">
        <h1>Your all-in-one productivity tool for students.</h1>
        <p>Track study time,boost focus, and stay organized.</p>
        <a href="signup.php" class="get-started-btn">Get Started</a> <!--redirects to the signup page for the new users-->
    </div>

    <div class="info-section"> <!--section for the website info-->
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

<section class="features"> <!--displays feautres of the website-->
     <h2>Our Features</h2> <!--tile-->

     <div class="feature-container"> <!--used for displaying feautre box-->
        <div class="feature-box"> <!--feature box for pomodoro-->
            <img src="images/timer.png" alt="pomodoro timer">  <!--image for pomodoro feature box-->
            <h3>Pomodoro Timer</h3> <!--title-->
            <p>Boost your focus with our integrated Pomodoro timer.</p>
        </div>
     <!--feature box for flashcards-->
        <div class="feature-box">
            <img src="images/flashcards.png" alt="flashcards"> <!--image for flashcard feautre box-->
            <h3>Flashcards</h3>
            <p>Enhance your memory with customizable flashcards.</p>
    </div>
  </div>
</section>
    </body>
</html>