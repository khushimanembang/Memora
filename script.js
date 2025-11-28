document.addEventListener('DOMContentLoaded', () => {

    // ===== POMODORO TIMER =====
    //const holds the reference to the html,...variable points to that element in DOM
    /*constant variable that stores reference to the HTML element with id 'timer'.*/
    const timerDisplay = document.getElementById('timer');
    const startPauseBtn = document.getElementById('startPause');
    const resetBtn = document.getElementById('reset');
    const pomodoroInput = document.getElementById('pomodoroTime');
    const flashcardBtn = document.getElementById('flashcardBtn');
    

    /*----checks if all the element exist on the page befor running the code--------*/
    if (timerDisplay && startPauseBtn && resetBtn && pomodoroInput && flashcardBtn) { 
        let pomodoroTime =0; /* variable to store pomodoro timer duration in minutes and seconds   */                                                     
        let timerInterval = null; /* Store interval ID returned by setInterval (start/stop the timer)*/
         /*check if the timer is running or not*/
        let isRunning = false;   

        /*for sound effect*/
        let alarmSound;
        document.getElementById('startPause').addEventListener('click',()=> {
        if(!alarmSound){
            alarmSound=new Audio('alarm.mp3');
            alarmSound.load(); /*preload it*/
        }
       })

        /* ---- VALIDATE INPUT ----*/
    function isValidInput() { 
        /*ensures that the user enter the valid input*/
        const value = pomodoroInput.value.trim();

        if (value === "" || isNaN(value) || parseInt(value) <= 0) {
            /*if it entered null, less than 0 or other values, shows alert message*/
            alert("⚠ Please enter a valid number of minutes."); 
            return false;
        }
        /*if the input is correct, it returns true*/
        return true; 
    }

        function updateTimerDisplay() {
            const minutes = String(Math.floor(pomodoroTime / 60)).padStart(2, '0'); /*--padstart change the number form 2 to 02--*/
            const seconds = String(pomodoroTime % 60).padStart(2, '0');
            /*display the time in minutes:seconds form*/
            timerDisplay.textContent = `${minutes}:${seconds}`; 
        }

        
        /*----------------function to start and pause the timer---------------------------------------------*/
        function startPauseTimer() {

        /*check if the timer is not running*/
            if(!isRunning){                                  
                if(!isValidInput())           
                    //returns to isValidInput() function                   
                    return;
                pomodoroTime= parseInt(pomodoroInput.value) * 60; /*converts the input value from minute to seconds and store it in pomodoroTime.*/
            }

             //check if the timer is running
            if (isRunning) {            
                 //stops the timer by clearing the interval                           
                clearInterval(timerInterval);   
                 //changes the button back to start to let the user know that the timer has been paused                   
                startPauseBtn.textContent = 'Start';                
            } else {
                //  Lock flashcards at start of a new Pomodoro
                flashcardBtn.disabled = true;   /*disables the flashback button*/          
                flashcardBtn.textContent = "Go to Flashcards"; 
                flashcardBtn.style.opacity = "0.5"; /*opacity of the button to make it look faded*/
                flashcardBtn.style.cursor = "not-allowed";    
                localStorage.removeItem('pomodoroComplete');     /*removes the flag to mark timer has been completed, so it resets for new session*/


                /*stores the interval ID in timerInterval so it can be cleared later*/
                timerInterval = setInterval(() => {             
                    if (pomodoroTime > 0) {                     
                        pomodoroTime--; 
                        /*call updateTimerDisplay() to update the timer on the screen.*/                        
                        updateTimerDisplay();       
                    } else {
                        /*otherwise if time is up, stop the timer.*/
                        clearInterval(timerInterval); 


                        /*-----------Unlock flashcards after Pomodoro----------------------------*/
                        flashcardBtn.disabled = false;                          
                        flashcardBtn.textContent = "Go to Flashcards";
                        flashcardBtn.style.opacity = "1";                       
                        flashcardBtn.style.cursor = "pointer";                  
                        localStorage.setItem('pomodoroComplete', 'true'); /*save ethe flag in local storage marking that the pomodoro has been completed.*/

                            if(alarmSound){
                                alarmSound.loop=true;
                                alarmSound.play().catch(err=>
                                    console.log("Audio blocked: ",err)
                                )
                            };
                        setTimeout(() => {
                        
                            alert("Pomodoro complete! Flashcards unlocked"); 
                            /*stop alarm after the user clicks ok*/
                            alarmSound.pause();
                            alarmSound.currentTime=0;
                            
                        }, 50 /*shows alert after 50 millisecond that timer has been completed*/);                                                 

                        /*reset the start/pause button text*/
                        startPauseBtn.textContent = 'Start';                    
                        isRunning = false;  /*indicates that the timer is not running*/
                    }
                }, 1000);                                                       //ends the setInterval callback that runs every 1 second

                /*if the timer is running change the button text to pause*/
                startPauseBtn.textContent = 'Pause';                         
            }
             /*toggles the isRunning flag, if it was false it becomes true, if it was true it becomes false*/
            isRunning = !isRunning;                                            
        }
    

       
        /*---------------function to reset the timer---------------------*/
        function resetTimer() {
            /*function to check if the entered input is valid*/
            if(!isValidInput()){ 
                pomodoroTime=0;
                updateTimerDisplay();
                return;
            }
            clearInterval(timerInterval); /*  stops the timer  */            
            pomodoroTime = parseInt(pomodoroInput.value) * 60;  //convert the minutes to seconds
            updateTimerDisplay();                              
            startPauseBtn.textContent = 'Start';               
            isRunning = false;                           

            /* Lock flashcards*/
            flashcardBtn.disabled = true;                       /*disable the flashcard button*/
            flashcardBtn.textContent = "Go to Flashcards";
            flashcardBtn.style.opacity = "0.5";
            flashcardBtn.style.cursor = "not-allowed";
            localStorage.removeItem('pomodoroComplete');
        }
        
         /*runs the code whenever user changes the input value*/
        pomodoroInput.addEventListener('change', () => {            
            if(!isValidInput()){
                pomodoroTime=0;
                updateTimerDisplay();
                return;
            }
            if (!isRunning) {
                pomodoroTime = parseInt(pomodoroInput.value) * 60;
                updateTimerDisplay();
            }
        });
       
        /*runs the startPause function once the start/Pause button is clicked*/
        startPauseBtn.addEventListener('click', startPauseTimer);   

        /*runs the reset function once the reset button is clicked*/
        resetBtn.addEventListener('click', resetTimer);             

        flashcardBtn.addEventListener('click', () => {
            if (!flashcardBtn.disabled) window.location.href = "flashcards.php"; 
        });

        updateTimerDisplay();                       /*initialize the timer dispaly so user sees 00:00*/
    }



    // ===== GOALS =====
    /*constant varaible that refers to the HTML element with id goalInput*/
    const goalInput = document.getElementById('goalInput'); 
    const addGoalBtn = document.getElementById('addGoalbtn');
    const goalList = document.getElementById('goalList');


    /*check if these element exist in the page before running the code*/
    if (goalInput && addGoalBtn && goalList) {              
        //function to create goal
        function createGoalItem(text) {
            const li = document.createElement('li');
            const spanText = document.createElement('span');
            spanText.textContent = text;
            spanText.classList.add('goal-text');

            const checkBtn = document.createElement('span');
            checkBtn.innerHTML = '✔️';
            checkBtn.classList.add('goal-check');

            /*once the user click th icon, the goal will be line crossed */
            checkBtn.addEventListener('click', () => {
                spanText.classList.toggle('completed');            
            });

            const deleteBtn = document.createElement('span');
            deleteBtn.innerHTML = '🗑️';
            deleteBtn.classList.add('goal-delete');
            /*if the user click the icon delete, the goal will be removed*/
            deleteBtn.addEventListener('click', () => li.remove());   

            li.appendChild(spanText);
            li.appendChild(checkBtn);
            li.appendChild(deleteBtn);
            goalList.appendChild(li);
        }
       /*executes addGoalBtn once the add button is clicked.*/
        addGoalBtn.addEventListener('click', () => {
            const goalText = goalInput.value.trim();
            if (goalText) {
                createGoalItem(goalText);
                goalInput.value = '';
            }
        });

        /*if the user press enter in keyboar, it adds the goal*/
        goalInput.addEventListener('keypress', (e) => {      
            if (e.key === 'Enter') addGoalBtn.click();            
        });
    }


    /*============ FLASHCARDS (Quizlet-style) ============================*/
    const createSection = document.getElementById('createSetSection');
    const quizSection = document.getElementById('quizSection');
    const addCardBtn = document.getElementById("addCardBtn");
    const createSetBtn = document.getElementById("createSetBtn");
    const cardsContainer = document.getElementById("cardsContainer");



    
    /*check if these element exist in the page before running the code*/
    if (addCardBtn && createSetBtn && cardsContainer) {
        let flashcards = [];

        /*Place to enter term and definition for the cards*/
        addCardBtn.addEventListener("click", () => {
            const cardDiv = document.createElement("div");
            cardDiv.classList.add("card-input");
            cardDiv.innerHTML = `
                <input type="text" placeholder="Term">
                <input type="text" placeholder="Definition">
            `;
            cardsContainer.appendChild(cardDiv);
        });

        createSetBtn.addEventListener("click", () => {
            const title = document.getElementById("setTitle").value.trim();
            const desc = document.getElementById("setDescription").value.trim();
            const cardInputs = document.querySelectorAll(".card-input");

            flashcards = Array.from(cardInputs)
                .map(div => {
                    const [term, def] = div.querySelectorAll("input");
                    return { term: term.value.trim(), def: def.value.trim() };
                })
                .filter(card => card.term && card.def);

            if (!title || flashcards.length === 0) {
                alert("Please add a title and at least one card!");
                return;
            }

            createSection.classList.add("hidden");
            quizSection.classList.remove("hidden");
            document.getElementById("quizTitle").textContent = title;
            document.getElementById("quizDescription").textContent = desc;

            startQuiz(flashcards);
        });
    }

    /*=============== QUIZ FUNCTION ==================================*/

    /*Function for the quiz part*/
    function startQuiz(flashcards) { 
        let index = 0;  /*current flashcard*/
        const quizTerm = document.getElementById("quizTerm");
        const option1 = document.getElementById("option1");
        const option2 = document.getElementById("option2");
        const nextBtn = document.getElementById("nextBtn");
        const restartBtn = document.getElementById("restartBtn");

        /*Function to show the question*/
        function showQuestion() {
            if (index >= flashcards.length) {
                quizTerm.textContent = "🎉 Quiz Complete!";
                option1.classList.add("hidden");
                option2.classList.add("hidden");
                nextBtn.classList.add("hidden");
                restartBtn.classList.remove("hidden");
                return;
            }

            const card = flashcards[index];
            const wrong = flashcards[Math.floor(Math.random() * flashcards.length)].def;
            const options = [card.def, wrong].sort(() => Math.random() - 0.5);

            quizTerm.textContent = card.term;
            option1.textContent = options[0];
            option2.textContent = options[1];
        }


        /*Function to change the color of the option if it is wrong or right*/
        option1.onclick = option2.onclick = e => {
            const correct = flashcards[index].def;
            if (e.target.textContent === correct) {
                e.target.style.background = "#90EE90";
            } else {
                e.target.style.background = "#FF6B6B";
            }
            nextBtn.classList.remove("hidden");
        };

        /*Button to move to next card.*/
        nextBtn.onclick = () => {
            index++;
            option1.style.background = option2.style.background = "#ffe600";
            nextBtn.classList.add("hidden");
            showQuestion();
        };

        /*Restart the quiz with new questions*/
        restartBtn.onclick = () => location.reload();
        showQuestion();
    }
});

