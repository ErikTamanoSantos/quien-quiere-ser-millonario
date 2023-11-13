addEventListener('load', init);
function init() {
    document.getElementsByTagName("main")[0].classList.remove("d-none")
    document.getElementsByTagName("noscript")[0].classList.add("d-none")
    let win_button = document.getElementById('win-transition');
    if (win_button != null) {
        win_button.addEventListener('click', () => {
            // Pasar de la primera secció de "win.php" a la segona quan has encertat les 18 preguntes.
            const winBefore = document.querySelector('.win-before');
            const winAfter = document.querySelector('.win-after');

            winBefore.style.display = 'none';
            winAfter.style.display = 'flex';

            const winAudio = new Audio('audios/win.mp3');

            winAudio.volume = 1;
            winAudio.loop = true;

            winAudio.play();
        });
    }

    let save_button = document.getElementById('save-score');
    if (save_button != null) {
        save_button.addEventListener('click', showSaveScoreForm);
    }
}

function showSaveScoreForm() {
    let save_score_form = document.getElementById('save-score-form') 
    save_score_form.style.display = null
}