const correct_audio = new Audio('audios/correct.mp3');
const fail_audio = new Audio('audios/fail.mp3');
let currQuest = 0;
let questionFlags = [true, false, false];
let extraTime = false;
let publicHintOnScreen = false;
let hintDelay = 0;

addEventListener('load', init);
function init() {
    document.getElementsByTagName("nav")[0].classList.remove("d-none")
    document.getElementsByTagName("main")[0].classList.remove("d-none")
    document.getElementsByTagName("noscript")[0].classList.add("d-none")
    document.querySelector(".fifty").addEventListener('click', hint_50_50);
    document.querySelector(".add-time").addEventListener('click', hint_time);
    document.querySelector(".public").addEventListener('click', hint_spectators);

    let correct_buttons = document.getElementsByClassName("correct-button");
    for (let i = 0; i < correct_buttons.length; i++) {
        correct_buttons[i].addEventListener('click', click_correct_answer);
    }
    let wrong_buttons = document.getElementsByClassName("wrong-button");
    for (let i = 0; i < wrong_buttons.length; i++) {
        wrong_buttons[i].addEventListener('click', click_wrong_answer);
    }

    if (get_cur_level() > 1) {
        let question_timer = document.querySelector("#question-0 .question-timer")
        runTimer(question_timer, currQuest);    
    }
    

    createClock();
    
}


function createClock() {
    let startTime = 0;
    let pauseTime = 0;
    let timeRunning = false;
    let interval;
    let wannaRestart = true;
    
    if (document.getElementById('reloj').innerText !== '0:00') {
        let tiempoPasado = document.getElementById('reloj').innerText;
        let minutos_segundos = tiempoPasado.split(':');
        startTime = Date.now() - (minutos_segundos[0] * 60000 + minutos_segundos[1] * 1000);
        timeRunning = true;
        wannaRestart = false;
        interval = setInterval(showTime, 1000);
    }

    if (!timeRunning && wannaRestart) {
        startTime = Date.now();
        timeRunning = true;
        wannaRestart = false;
        interval = setInterval(showTime, 1000);
    }

    
    function showTime() {
        if (!publicHintOnScreen) {
            const currentTime = (timeRunning ? Date.now() : pauseTime) - (startTime + hintDelay*1000);
            const seconds = Math.floor(currentTime / 1000);
            const minutes = Math.floor(seconds / 60);
            document.getElementById("reloj").innerText = minutes + ":" + (seconds % 60).toString().padStart(2, '0');
            document.querySelector('#next-level-container input[name="clock"]').setAttribute('value', document.getElementById('reloj').innerText);
        } else {
            hintDelay++
        }
    }

    showTime();
}

function runTimer(timerElement, questionNumber) {
    console.log(timerElement)
    let startTime = Date.now();
    let pauseTime = 0;
    let timeRunning = true;
    let interval = setInterval(showTime, 1000);
    let wannaRestart = false;

    function showTime() {
        if (timeRunning && questionFlags[questionNumber] && !publicHintOnScreen) {
            let maxTime = 60;
            if (extraTime) {
                maxTime += 20;
            }
            const timePassed = (timeRunning ? Date.now() : pauseTime) - (startTime + hintDelay*1000);
            const seconds = Math.floor(timePassed / 1000);
            const timeRemaining = maxTime - seconds;
            if (timeRemaining == 0) {
                document.getElementById("reason").value = "Timeout"
                document.getElementById("lose_form").submit()
            }
            timerElement.innerText = timeRemaining.toString().padStart(2, '0');
        }
        
    }

    showTime();
}


function click_correct_answer() {
    questionFlags[currQuest] = false
    currQuest++;
    questionFlags[currQuest] = true
    correct_audio.play();
    let question_number = get_question_number(this)
    console.log(this)
    console.log(question_number)
    if (question_number < 2) {
        show_question(question_number+1)
        this.classList.add("clicked")
        let answer_div = get_answer_div(this)
        console.log(answer_div)
        let msg = get_correct_message_div(this);
        msg.classList.remove("d-none")
        disable_buttons(answer_div);
        if (get_cur_level() > 1) {
            let question_timer = document.querySelector(`#question-${currQuest} .question-timer`)
            runTimer(question_timer, currQuest);
        }
    } else {
        this.classList.add("clicked")
        let answer_div = get_answer_div(this)
        disable_buttons(answer_div);
        console.log(get_score(question_number, true))
        document.getElementById("next-level-container").classList.remove("d-none")
        document.getElementById("next-level-container").scrollIntoView()
        if (get_cur_level() == 6) {
            document.getElementById("final_score").value = get_score(question_number, true)
        }
    }
}

function hint_50_50() {
    let wrong_answers_array = document.querySelectorAll(`#question-${currQuest} .wrong-button`);
    let wrong_answer_enabled = Math.floor(Math.random(3));
    console.log(wrong_answer_enabled)
    for (let i = 0; i < wrong_answers_array.length; i++) {
        if (i != wrong_answer_enabled) {
            wrong_answers_array[i].disabled = true;
        }
    }
    document.getElementsByClassName("fifty")[0].disabled = true;
}

function hint_time() {
    extraTime = true;
    let timerElement = document.querySelector(`#question-${currQuest} .question-timer`)
    timerElement.innerText = parseInt(timerElement.innerText) + 20
    document.getElementsByClassName("add-time")[0].disabled = true;
}

function hint_spectators() {
    publicHintOnScreen = true;
    let stillPlayingModal = true;
    const activeQuestion = getActiveQuestion(); // Conseguir las preguntas de la pregunta actual.
    let activeAnswers;

    // Conseguir respuestas de la pregunta actual.
    for (activeQuestionChild of activeQuestion.children) {
        if (activeQuestionChild.classList.contains("answer-container")) {
            activeAnswers = activeQuestionChild.children;
            break;
        }
    }

    //Conseguir respuesta correcta.
    let correctAnswerIndex = 0;
    for (answer of activeAnswers) {
        if (answer.classList.contains("correct-button")) break;
        correctAnswerIndex++;
    }

    // Mostrar modal
    document.querySelector(".modal").style.display = "flex";

    // Almaceno los mensajes de la parte de abajo de la modal.
    let messages = document.querySelector(".spectators-sms p").innerText;
    messages = messages.split("|");

    document.querySelector(".spectators-sms p").innerText = messages[0];    // Muestro solo el primer mensaje.

    // Decidir si la respuesta del público será correcta.
    const publicoCorrecto = Math.floor(Math.random()*100 + 1) < 80; // true || false

    console.log(activeAnswers);

    let nuevoNumero;
    let puntosRestantes;
    let bigPublicAnswer;
    let otherAnswers = [];

    do { bigPublicAnswer = Math.floor(Math.random() * 61) } 
    while (bigPublicAnswer < 50);
    
    puntosRestantes = 100 - bigPublicAnswer;
    let vueltas = 0;
    for (let i = 0; i < 3; i++) {
        if (vueltas === 2) otherAnswers.push(puntosRestantes);
        else {
            nuevoNumero = Math.floor(Math.random()*puntosRestantes);
            puntosRestantes -= nuevoNumero;
            otherAnswers.push(nuevoNumero);
            vueltas++;
        }
    }

    // Crear los datos del gráfico de barras.
    let data = [];
    let otherAnswersIndexes = 0;
    let dataNumber;

    for (let i = 0; i < 4; i++) {
        if (i !== correctAnswerIndex) {
            dataNumber = otherAnswers[otherAnswersIndexes];
            otherAnswersIndexes++;
        } else  {
            dataNumber = bigPublicAnswer;
        }
        data.push({
            x: activeAnswers[i].innerText,
            y: dataNumber
        })
    }

    // Configuració del gràfic de barres.
    options = {
        chart: {
            type: 'bar',
            width: '1500px',
            height: '300px',
            foreColor: "#ffffff"
        },
        series: [{
            data: data
        }]
    }
    // Creació i configuració dels audios de la modal.
    const showVotes = new Audio("/audios/show-votes.mp3");
    const voting = new Audio("/audios/voting.mp3");
    voting.loop = false;
    voting.play();

    let contador;

    setTimeout(() => {
        document.querySelector(".spectators-sms p").style.opacity = 0;
        setTimeout(() => {
            document.querySelector(".spectators-sms p").innerText = messages[1];
            document.querySelector(".spectators-sms p").style.opacity = 1;
        }, 300);
    }, 5000);

    setTimeout(() => {
        document.querySelector(".modal").style.justifyContent = "center";
        document.querySelector(".spectators-content").style.height = "80vh";
        document.querySelector(".spectators-sms").style.display = "none";
    }, 10000);
    
    setTimeout(() => {
        document.querySelector(".modal-content-bottom-row h3").innerText = "Procesando votos..."
    }, 12000);

    setTimeout(() => {
        voting.pause();
        if (stillPlayingModal) showVotes.play();
        contador = document.querySelector(".loader");
        contador.classList.remove("loader");
        contador.classList.add("modal-cont");
        contador.style.color = "#b8c1ec";
        contador.style.fontSize = "7vw";
        contador.innerText = "3";
    }, 13000);

    setTimeout(() => {
        document.querySelector(".modal-cont");
        contador.style.color = "#eebbc3";
        contador.innerText = "2";
    }, 14000);

    setTimeout(() => {
        contador = document.querySelector(".modal-cont");
        contador.style.color = "#fabf5b";
        contador.innerText = "1";
    }, 15000);

    setTimeout(() => {
        contador.innerText = null;
        var chart = new ApexCharts(document.querySelector("#spectators-chart"), options);
        chart.render();
    }, 16000);

    // Tancar la modal, pausant els audios si sonen.
    document.querySelector(".close-modal").addEventListener('click', () => {
        stillPlayingModal = false;
        document.querySelector(".public").disabled = true;
        document.querySelector(".modal").style.display = "none";
        if (!voting.paused) voting.pause();
        if (!showVotes.paused) showVotes.pause();
        publicHintOnScreen = false;
    });
}

function getActiveQuestion() {
    const questContainers = document.getElementsByClassName('question-inner-container');
    return questContainers[currQuest];
}

function click_wrong_answer() {
    fail_audio.play();
    this.classList.add("clicked")
    let answer_div = get_answer_div(this)
    let question_number = get_question_number(this)
    document.getElementById("lose_final_score").value = get_score(question_number)
    document.getElementById("reason").value = "Answer"
    document.getElementById("lose_correct_answers").value = parseInt(get_cur_level())*3 + parseInt(question_number)-1;
    document.getElementById("lose_form").submit()
    let msg = get_wrong_message_div(this);
    msg.classList.remove("d-none");
    disable_buttons(answer_div);
}

function get_question_number(html_element) {
    return parseInt(html_element.parentNode.parentNode.parentNode.getAttribute("question-number"))
}

function get_answer_div(html_element) {
    return html_element.parentNode
}

function get_correct_message_div(button) {
    return button.parentNode.parentNode.querySelectorAll(":scope .message-correct")[0]
}

function get_wrong_message_div(button) {
    return button.parentNode.parentNode.querySelectorAll(":scope .message-wrong")[0]
}

function show_question(question_number) {
    let question_div = document.querySelectorAll(`[question-number='${question_number}']`)[0]
    question_div.classList.remove("hidden-question")
    question_div.scrollIntoView();

}

function disable_buttons(button_div) {
    let buttons_array = button_div.children
    for (let i = 0; i < buttons_array.length; i++) {
        buttons_array[i].disabled = true
    }
}

function get_time() {
    let clock = document.getElementById("reloj").innerHTML
    clock = clock.split(":")
    return parseInt(clock[0])*60 + parseInt(clock[1])
}

function get_score(question_number, win = false) {
    let cur_level = get_cur_level();
    let score = 0;
    if (win) {
        for (let i = 1; i < cur_level; i++) {
            score += i * 3 * 100;
        }
        score += cur_level * question_number * 100
        let time = get_time();
        if (time < 300) {
            score += Math.floor(1000 - (1000/300) * time)
        }
    } else {
        for (let i = 1; i < cur_level; i++) {
            score += i * 3 * 100;
        }
        score += cur_level * question_number * 100
    }
    return score;
}

function get_cur_level() {
    return document.getElementById("cur_level").getAttribute("value");
}