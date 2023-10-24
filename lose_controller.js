addEventListener('load', () => {
    const button = document.querySelector("button");
    button.addEventListener('click', () => {
        const lose = new Audio('audios/game-over.mp3');
        lose.play();
    });
});