<?php
   session_start();
if(!isset($_SESSION['user_id'])){
   header("Location:login.php"); //It redirects to login.php if user has not logged in//
}

$user_name=$_SESSION['user_name']; //It fetches username of the user from the session variable//
?>

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
            <h1><span>CARD</span>odoro</h1>
</div>
 <nav class="navbar">
    <ul>
        <a href="index.php">Logout</a> <!--refer to index.php to logout-->
</ul>
</nav>
</header>

 <div class="hello">
        Hello, <?php echo htmlspecialchars($user_name); ?>! <!--Displays the username of the logged user-->
     </div>

<div class="pomodoro"> <!--Center part that contains timer and buttons-->
    <h2>Pomodoro Timer</h2> <!--title of the center part-->
    <div>
        <label for="pomodoro">Set Time(minutes): <!--label for input-->
        </label>
        <input type="number" id="pomodoroTime" min="1" value="1"> <!--ensures that only numbers are entered by the user-->
</div>
<div id="timer">00:00</div>
<div class="text">
    <p><i>Stay focused.You got this!</i></p>
</div>
<div class="timer-control"> <!--used for controlling the buttons-->
    <button id="startPause">Start</button> <!--used for both start/pause function-->
    <button id="reset">Reset</button><!--It reset the timer-->
    <button id="flashcardBtn" disabled>Go to Flashcards</button><!--This button takes user to flashcard page once the pomodoro is completed-->

</div>
</div>

<!--Goals section to track the user daily goals-->
<div class="goals">
    <h2>Today's Goals</h2><!--title-->
    <div class="add-goal"> <!--This division add goals-->
        <input type="text" id="goalInput" placeholder="Enter your goal">
        <button id="addGoalbtn">Add</button><!--button to add goals-->
</div>
<ul id="goalList"></ul><!--list the entered goals in unordered form-->
</div>

<div class="sidebar">
    <div class="status">
        <span class="label">Total Study Time</span>
        <span class="value" id="totalTime">0h 00m</span>
</div>

<div class="status">
    <span class="label">Streak</span>
    <span class="value" id="streakDays">0 days</span>
</div>
</div>

<script src="script.js"></script><!--link to javascript file for the timer to run-->
</body>
</html>