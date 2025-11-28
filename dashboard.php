<?php
   session_start();
   //It redirects to login.php if user has not logged in//
if(!isset($_SESSION['user_id'])){
   header("Location:login.php"); 
}

//It fetches username of the user from the session variable//
$user_name=$_SESSION['user_name']; 
?>

<!--html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard">
     <header>
        <div class="logo">
            <h1><span>MEM</span>ora</h1>
</div>
<!--For directing to the landing page-->
 <nav class="navbar">
    <ul>
        <a href="index.php">Logout</a> 
</ul>
</nav>
</header>

<!--Displays the username of the logged user-->
 <div class="hello">
        Hello, <?php echo htmlspecialchars($user_name); ?>! 
     </div>

     <!--Contains timer and buttons-->
<div class="pomodoro"> 
    <h2>Pomodoro Timer</h2> 
    <div>
        <label for="pomodoro">Set Time(minutes): 
            <!--label for input-->
        </label>
         <!--ensures that only numbers are entered by the user-->
        <input type="number" id="pomodoroTime" min="1" value="1">
</div>

<div id="timer">25:00</div>
<div class="text">
    <p><i>Stay focused.You got this!</i></p>
</div>

 <!--For controlling the buttons-->
<div class="timer-control">
     <!--used for both start/pause function-->
    <button id="startPause">Start</button>
    <!--It reset the timer-->
    <button id="reset">Reset</button>
    <!--This button takes user to flashcard page once the pomodoro is completed-->
    <button id="flashcardBtn" disabled>Go to Flashcards</button>

</div>
</div>

<!--Goals section to track the user daily goals-->
<div class="goals">
    <h2>Today's Goals</h2>

    <!--For adding goals-->
    <div class="add-goal"> 
        <input type="text" id="goalInput" placeholder="Enter your goal">
        <button id="addGoalbtn">Add</button>
</div>
<ul id="goalList">
    <!--list the entered goals in unordered form-->
</ul>
</div>
</div>



<!--link to javascript file for the timer to run-->
<script src="script.js"></script>
</body>
</html>