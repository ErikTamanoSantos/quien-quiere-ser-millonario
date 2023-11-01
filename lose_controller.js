addEventListener('load', () => {
    const button = document.querySelector("button");
    const firstLose = document.querySelector(".first-lose");
    const secondLose = document.querySelector(".second-lose")
    button.addEventListener('click', () => {
        const lose = new Audio('audios/game-over.mp3');
        lose.volume = 0.5;
        lose.play();

        secondLose.style.display = "flex";
        firstLose.style.display = "none";
    });

    setTimeout(window.scrollBy(0,1), 10);

    
});

function showSaveScoreForm() {
    let save_score_form = document.getElementById('save-score-form') 
    save_score_form.style.display = null
}