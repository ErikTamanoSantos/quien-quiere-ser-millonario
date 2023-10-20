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
    console.log(this)
    let question_number = get_question_number(this)
    console.log(question_number)
    show_question(question_number+1)
    this.classList.add("clicked")
    let answer_div = get_answer_div(this)
    disable_buttons(answer_div);
}

function click_wrong_answer() {
    let question_number = get_question_number(this)
    this.classList.add("clicked")
    let answer_div = get_answer_div(this)
    disable_buttons(answer_div);
}

function get_question_number(html_element) {
    return parseInt(html_element.parentNode.parentNode.getAttribute("question-number"))
}

function get_answer_div(html_element) {
    return html_element.parentNode
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