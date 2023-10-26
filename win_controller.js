addEventListener('load', init);
function init() {
    const button = document.getElementById('win-transition');
    button.addEventListener('click', () => {
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