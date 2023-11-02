addEventListener('load', ring);
function ring() {
    document.getElementsByTagName("main")[0].classList.remove("d-none")
    document.getElementsByTagName("noscript")[0].classList.add("d-none")
    const button = document.getElementById('ring-button');
    button.addEventListener('click', () => {
        const pupup = new Audio('audios/ajuda1.mp3');
        const ringring = new Audio('audios/ajuda2.mp3');

        pupup.play();
        setTimeout(() => { ringring.play() }, 4000);
    });
}