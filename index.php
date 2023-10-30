<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui vol ser milionari?</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        session_start();
        if (isset($_POST["idioma"])) {
            $_SESSION["idioma"] = $_POST["idioma"];
        }
        echo $_POST["idioma"];

        if (isset($_SESSION["idioma"])) {
            $jsonFile = file_get_contents("texts.json");
            $_SESSION["jsonTexts"] = json_decode($jsonFile) -> $_SESSION["idioma"];
            echo "a".$_SESSION["jsonTexts"];
        } else {
            $jsonFile = file_get_contents("texts.json");
            $_SESSION["jsonTexts"] = json_decode($jsonFile) -> ca;
            echo "a".$_SESSION["jsonTexts"];
        }
        
    ?>
    <main class="main-slider">
        <section id="index-header" class="slider">
            <nav id="index-nav">
                <form action="" method="POST">
                    <select name="idioma" id="idioma">
                        <?php echo '<option value="ca"'. (!isset($_SESSION["idioma"]) ? ' selected' : '') .'>🏴󠁥󠁳󠁣󠁴󠁿 Català</option>'; ?>
                        <?php echo '<option value="es"'. ($_SESSION["idioma"] === "es" ? ' selected' : '') .'>🇪🇸 Español</option>'; ?>
                        <?php echo '<option value="en"'. ($_SESSION["idioma"] === "en" ? ' selected' : '') .'>🇺🇸 English</option>'; ?>
                    </select>
        
                    <?php echo '<input type="submit" value="'. var_dump($_SESSION["jsonTexts"]) /*-> index -> change_lang*/ .'">'; ?>
                </form>
            </nav>
            <section id="header-title">
                <h1>Qui vol ser<br>MILIONARI</h1>
                <a href="game.php">JUGAR</a>
            </section>
            <section id="header-scroll">
                <p>Fes scroll cap abaix per <br>veure les instruccions</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z" stroke-width="0" fill="currentColor"></path>
                </svg>
            </section>
        </section>
        
        <section class="how-to-play slider">
            <h1>Com jugar al "Qui vol ser milionari"?</h1>
            <div class="primera-instruccion">
                <p>En aquest joc hauràs d'afrontar-te a un total de 18 preguntes de cultura general. <br>
                    Et farem una pregunta i tindràs 4 posibles respostes. Si falles, hauràs de tornar a començar, si l'encertes, <br>
                    hauràs de contestar una altra pregunta.</p>
                <img src="imgs/juego-instrucciones.png" alt="Imagen de ejemplo estructura preguntas y respuestas">
            </div>
        </section>

        <section class="how-to-play slider">
            <h1>Dificultat progresiva</h1>
            <div class="primera-instruccion">
                <p>Cada 3 preguntes que aconsegueixis respondre, la dificultat augmentarà. <br>
                    La dificultat continuarà progresant fins arribar a les 18 preguntes encertades. Llavors, hauràs guanyat el joc! <br><br>
                    Vols probar?</p>
                <a href="#index-header">Torna adalt i proba-hi!</a>
            </div>
            <button id="ring-button">ringring</button>
        </section>
    </main>
    <script src="help_controller.js"></script>
</body>
</html>