<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRUEBAS</title>
</head>
<body>
    <p id="reloj">0:00</p>
    <span><button id='start'>Start</button><button id="stop">Stop</button><button id="reset">Reset</button></span>
    <script>
        let tiempoInicio = 0;
        let cronometroCorriendo = false;
        let intervalo;

        function mostrarTiempo() {
            const tiempoActual = (cronometroCorriendo ? Date.now() : tiempoPausado) - tiempoInicio;
            const segundos = Math.floor(tiempoActual / 1000);
            const minutos = Math.floor(segundos / 60);
            document.getElementById("reloj").innerText = minutos + ":" + (segundos % 60).toString().padStart(2, '0');
        }

        document.getElementById("start").addEventListener("click", function() {
            if (!cronometroCorriendo) {
                tiempoInicio = Date.now();
                intervalo = setInterval(mostrarTiempo, 1000);
                cronometroCorriendo = true;
            }
        });

        document.getElementById("reset").addEventListener("click", function() {
            clearInterval(intervalo);
            cronometroCorriendo = false;
            tiempoInicio = 0;
            tiempoPausado = 0;
            mostrarTiempo();
        });

        mostrarTiempo();
    </script>
</body>
</html>