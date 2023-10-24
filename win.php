<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Has guanyat!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main id="main-win">
        <?php
        // $_SESSION["acertadas"] = 18;
        if ($_SESSION["acertadas"] !== 18) {
            echo "<section id='bad-win'><h1>No t'emportaràs cap premi fent trampes!</h1>";
            echo '<span id="tornar"><a href="http://localhost:8080">Tornar a l\'inici</a><span>👈</span></span><section>';
        } else {
            echo '
                <section class="win-before">
                    <h1>Has respost totes les preguntes!</h1>
                    <h3>Saps què vol dir això...?</h3>

                    <button id="win-transition">No, què vol dir?</button>
                </section>

                <section class="win-after" style="display: none;">
                    <h1>Enhorabona!</h1>
                    <svg id="money-svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                        <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                        <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                        <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                        <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                    </svg>
                </section>
            ';  
        }
    ?>
    </main>
    <script src="win_controller.js"></script>
</body>
</html>