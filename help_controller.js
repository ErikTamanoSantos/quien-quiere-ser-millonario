addEventListener('load', init);
function init() {
    document.getElementsByTagName("main")[0].classList.remove("d-none")
    document.getElementsByTagName("noscript")[0].classList.add("d-none")
    document.getElementById("title").addEventListener("click", show_easter_egg)
}

function show_easter_egg() {
    render_easter_egg_frame()
}

let image = document.getElementById("easter-egg")
let started = false;
let frame = 1;
let returning = false;

function render_easter_egg_frame() {
    if (!started) {
        started = true;
        image.classList.remove("d-none")
    } else if (returning && frame == 0) {
        image.classList.add("d-none");
        returning = false;
        started = false;
        frame = 1;
        return;
    } else if (frame == 7) {
        returning = true
    }

    image.style.backgroundImage = `url(imgs/easter_egg/${frame}.png)`

    if (returning) {
        setTimeout(render_easter_egg_frame, 650)
        frame--;
    } else {
        setTimeout(render_easter_egg_frame, 650)
        frame++
    }
}