addEventListener('load', ring);
function ring() {
    const button = document.getElementById('ring-button');
    button.addEventListener('click', () => {
        const pupup = new Audio('audios/ajuda1.mp3');
        const ringring = new Audio('audios/ajuda2.mp3');

        pupup.play();
        setTimeout(() => { ringring.play() }, 4000);
    });
}