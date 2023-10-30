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

        if (isset($_SESSION["idioma"])) {
            $jsonFile = file_get_contents("texts.json");
            $_SESSION["jsonTexts"] = json_decode($jsonFile, true)[$_SESSION["idioma"]];
        } else {
            $jsonFile = file_get_contents("texts.json");
            $_SESSION["jsonTexts"] = json_decode($jsonFile, true)["ca"];
        }
        
    ?>
    <main class="main-slider">
        <section id="index-header" class="slider">
            <nav id="index-nav">
                <form action="" method="POST">
                    <select name="idioma" id="idioma">
                        <?php echo '<option value="ca"'. (!isset($_SESSION["idioma"]) || $_SESSION["idioma"] === "ca" ? ' selected' : '') .'>🏴󠁥󠁳󠁣󠁴󠁿 Català</option>'; ?>
                        <?php echo '<option value="es"'. ($_SESSION["idioma"] === "es" ? ' selected' : '') .'>🇪🇸 Español</option>'; ?>
                        <?php echo '<option value="en"'. ($_SESSION["idioma"] === "en" ? ' selected' : '') .'>🇺🇸 English</option>'; ?>
                    </select>
        
                    <?php echo '<input type="submit" value="'. $_SESSION["jsonTexts"]["index"]["change_lang"] .'">'; ?>
                </form>
            </nav>
            <section id="header-title">
                <?php echo '<h1>'. $_SESSION["jsonTexts"]["index"]["title"] .'</h1>' ?>
                <?php echo '<a href="game.php">'. $_SESSION["jsonTexts"]["index"]["play_button"] .'</a>'; ?>
            </section>
            <section id="header-scroll">
                <?php echo '<p>'. $_SESSION["jsonTexts"]["index"]["scroll_instructions"] .'</p>' ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z" stroke-width="0" fill="currentColor"></path>
                </svg>
            </section>
        </section>
        
        <section class="how-to-play slider">
            <?php echo '<h1>'. $_SESSION["jsonTexts"]["index"]["1st_instructions_title"] .'</h1>' ?>
            <div class="primera-instruccion">
                <?php echo '<p>'. $_SESSION["jsonTexts"]["index"]["1st_instructions"] .'</p>'; ?>
                <img src="imgs/juego-instrucciones.png" alt="Imagen de ejemplo estructura preguntas y respuestas">
            </div>
        </section>

        <section class="how-to-play slider">
            <?php echo '<h1>'. $_SESSION["jsonTexts"]["index"]["2nd_instructions_title"] .'</h1>' ?>
            <div class="primera-instruccion">
                <?php echo '<p>'. $_SESSION["jsonTexts"]["index"]["2nd_instructions"] .'</p>' ?>
                <?php echo '<a href="#index-header">'. $_SESSION["jsonTexts"]["index"]["return_header_button"] .'</a>' ?>
            </div>
            <!--<button id="ring-button">ringring</button>-->
        </section>
    </main>
    <script src="help_controller.js"></script>
</body>
</html>