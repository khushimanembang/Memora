<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flashcards</title>
  <link rel="stylesheet" href="style.css" >
</head>
<body class="flashcard-app">
  <header>
    <!--Logo-->
    <h1><span>MEM</span>ora</h1> 
    <!--For directing page to dashboard-->
    <nav class="navbar">
    <ul>
        <a href="dashboard.php">Home</a> 
</ul>
</nav>
  </header>
  

  <main class="container">
    <!-- Step 1: Create Flashcard Set -->
    <section id="createSetSection" class="create-set">
      <!--Title for creating flashcard-->
      <h2>Create a New Set</h2> 
      <!--Title of the subject user had studied-->
      <input type="text" id="setTitle" placeholder="Set Title" />
      <!--Description of the title-->
      <textarea id="setDescription" placeholder="Set Description"></textarea>

   
      <div id="cardsContainer">
         <!--Holds the flashcards which is used afterwards for quiz-->
      </div> 
      <!--Button to add new cards and create the set-->
      <button id="addCardBtn" class="secondary">+ Add Card</button> 
      <button id="createSetBtn" class="primary">Create Set</button>
    </section>


    <!-- Step 2: Quiz Section -->
    <section id="quizSection" class="quiz hidden"> <!--it initially hides the quiz section -->
      <h2 id="quizTitle"></h2>
      <p id="quizDescription"></p>

      <div id="quizCard" class="quiz-card">
        <p id="quizTerm">
          <!--Displays the question-->
        </p> 
         <!--displays the options-->
        <div class="options">
          <button class="option" id="option1"></button>
          <button class="option" id="option2"></button>
        </div>
      </div>
      <!--Button to next question and restart which is kept hidden initially-->
      <button id="nextBtn" class="primary hidden">Next</button> 
      <button id="restartBtn" class="secondary hidden">Restart</button>
    </section>
  </main>

   <!--link to javascript for the flashcards functionality-->
  <script src="script.js"></script> 
</body>
</html>
