const correct_audio = new Audio('audios/correct.mp3');
const fail_audio = new Audio('audios/fail.mp3');
let currQuest = 0;

addEventListener('load', init);
function init() {
    document.getElementsByTagName("nav")[0].classList.remove("d-none")
    document.getElementsByTagName("main")[0].classList.remove("d-none")
    document.getElementsByTagName("noscript")[0].classList.add("d-none")
    document.querySelector(".fifty").addEventListener('click', hint_50_50);
    document.querySelector(".public").addEventListener('click', hint_spectators);

    let correct_buttons = document.getElementsByClassName("correct-button");
    for (let i = 0; i < correct_buttons.length; i++) {
        correct_buttons[i].addEventListener('click', click_correct_answer);
    }
    let wrong_buttons = document.getElementsByClassName("wrong-button");
    for (let i = 0; i < wrong_buttons.length; i++) {
        wrong_buttons[i].addEventListener('click', click_wrong_answer);
    }

    let question_timer = document.querySelector("#question-0 .question-timer")
    runTimer(question_timer);

    

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
        const currentTime = (timeRunning ? Date.now() : pauseTime) - startTime;
        const seconds = Math.floor(currentTime / 1000);
        const minutes = Math.floor(seconds / 60);
        document.getElementById("reloj").innerText = minutes + ":" + (seconds % 60).toString().padStart(2, '0');
        document.querySelector('#next-level-container input[name="clock"]').setAttribute('value', document.getElementById('reloj').innerText);
    }

    showTime();
}

function runTimer(timerElement) {
    console.log(timerElement)
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

    /*
    function showTime() {
        const currentTime = (timeRunning ? Date.now() : pauseTime) - startTime;
        const seconds = Math.floor(currentTime / 1000);
        const minutes = Math.floor(seconds / 60);
        document.getElementById("reloj").innerText = minutes + ":" + (seconds % 60).toString().padStart(2, '0');
        document.querySelector('#next-level-container input[name="clock"]').setAttribute('value', document.getElementById('reloj').innerText);
    }
    */

    function showTime() {
        if (timeRunning) {
            const timePassed = (timeRunning ? Date.now() : pauseTime) - startTime;
            const seconds = Math.floor(timePassed / 1000);
            const timeRemaining = 10 - seconds;
            if (timeRemaining == 0) {
                timeRunning = false;
            }
            timerElement.innerText = (timeRemaining % 60).toString().padStart(2, '0');
        }
        
    }

    showTime();
}


function click_correct_answer() {
    currQuest++;
    correct_audio.play();
    let question_number = get_question_number(this)
    if (question_number < 2) {
        show_question(question_number+1)
        this.classList.add("clicked")
        let answer_div = get_answer_div(this)
        let msg = get_correct_message_div(this);
        msg.classList.remove("d-none")
        disable_buttons(answer_div);
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
    console.log("no :P")
}

function hint_spectators() {
    const activeQuestion = getActiveQuestion();

    var options = {
        chart: {
          type: 'line'
        },
        series: [{
          name: 'sales',
          data: [30,40,35,50,49,60,70,91,125]
        }],
        xaxis: {
          categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
      }
      
      var chart = new ApexCharts(document.querySelector("#spectators-chart"), options);
      
      chart.render();
}

function getActiveQuestion() {
    const questContainers = document.getElementsByClassName('question-container');
    return questContainers[currQuest];
}

function click_wrong_answer() {
    fail_audio.play();
    this.classList.add("clicked")
    let answer_div = get_answer_div(this)
    let question_number = get_question_number(this)
    document.getElementById("lose_final_score").value = get_score(question_number)
    document.getElementById("lose_correct_answers").value = parseInt(get_cur_level())*3 + parseInt(question_number)-1;
    document.getElementById("lose_form").submit()
    let msg = get_wrong_message_div(this);
    msg.classList.remove("d-none");
    disable_buttons(answer_div);
}

function get_question_number(html_element) {
    return parseInt(html_element.parentNode.parentNode.getAttribute("question-number"))
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