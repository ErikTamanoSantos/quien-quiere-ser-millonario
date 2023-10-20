addEventListener('load', init);
function init() {
    const button = document.getElementById('win-transition');
    button.addEventListener('click', () => {
        const winBefore = document.querySelector('.win-before');
        const winAfter = document.querySelector('.win-after');

        winBefore.style.display = 'none';
        winAfter.style.display = 'flex';

        const winAudio = new Audio('audios/win.mp3');
        winAudio.play();
    });
}