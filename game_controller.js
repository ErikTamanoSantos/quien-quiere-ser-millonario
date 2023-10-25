const correct_audio = new Audio('audios/correct.mp3');
const fail_audio = new Audio('audios/fail.mp3');

addEventListener('load', init);
function init() {
    let correct_buttons = document.getElementsByClassName("correct-button");
    for (let i = 0; i < correct_buttons.length; i++) {
        correct_buttons[i].addEventListener('click', click_correct_answer);
    }
    let wrong_buttons = document.getElementsByClassName("wrong-button");
    for (let i = 0; i < wrong_buttons.length; i++) {
        wrong_buttons[i].addEventListener('click', click_wrong_answer);
    }
}

function click_correct_answer() {
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
        document.getElementById("next-level-container").classList.remove("d-none")
    }
}

function click_wrong_answer() {
    fail_audio.play();
    this.classList.add("clicked")
    let answer_div = get_answer_div(this)
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
    document.querySelectorAll(`[question-number='${question_number}']`)[0].classList.remove("hidden-question")
}

function disable_buttons(button_div) {
    let buttons_array = button_div.children
    for (let i = 0; i < buttons_array.length; i++) {
        buttons_array[i].disabled = true
    }
}