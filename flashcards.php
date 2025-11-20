<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quizlet Style Flashcards</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="flashcard-app">
  <header>
    <h1><span>CARD</span>odoro</h1> <!--Logo-->
    <nav class="navbar">
    <ul>
        <a href="dashboard.php">Home</a> <!--refers to the dashboard.php-->
</ul>
</nav>
  </header>
  

  <main class="container">
    <!-- Step 1: Create Flashcard Set -->
    <section id="createSetSection" class="create-set">
      <h2>Create a New Set</h2> <!--Title for creating flashcard-->
      <input type="text" id="setTitle" placeholder="Set Title" /><!--Title of the subject user had studied-->
      <textarea id="setDescription" placeholder="Set Description"></textarea><!--Description of the title-->

      <div id="cardsContainer"></div> <!--Holds the flashcards which is used afterwards for quiz-->

      <button id="addCardBtn" class="secondary">+ Add Card</button> <!--Button to add new cards-->
      <button id="createSetBtn" class="primary">Create Set</button><!--Button to create the set after the user completes adding cards-->
    </section>


    <!-- Step 2: Quiz Section -->
    <section id="quizSection" class="quiz hidden"> <!--it initially hides the quiz section -->
      <h2 id="quizTitle"></h2>
      <p id="quizDescription"></p>

      <div id="quizCard" class="quiz-card">
        <p id="quizTerm"></p> <!--Displays the question-->
        <div class="options">
          <button class="option" id="option1"></button> <!--displays the option 1-->
          <button class="option" id="option2"></button><!--displays the option 2-->
        </div>
      </div>
      <button id="nextBtn" class="primary hidden">Next</button> <!--Button to next question which is kept hidden initially-->
      <button id="restartBtn" class="secondary hidden">Restart</button><!--Button to restart the quiz which is kept hidden initially-->
    </section>
  </main>

  <script src="script.js"></script>  <!--link to javascript for the flashcards functionality-->
</body>
</html>
