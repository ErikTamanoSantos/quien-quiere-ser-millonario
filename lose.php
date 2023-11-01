<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Has perdido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="main-lose">
        <section class="first-lose">
            <?php  session_start();
            echo '<h1>'. $_SESSION["jsonTexts"]["lose"]["you_failed"] .'</h1>
            <h4>'. $_SESSION["jsonTexts"]["lose"]["you_know"] .'</h4>
            <button>'. $_SESSION["jsonTexts"]["lose"]["lose_next_button"] .'</button>'; ?>
        </section>

        <section class="second-lose">
            <section class="fixed-lose">
                <?php echo '<h1>'. $_SESSION["jsonTexts"]["lose"]["you_lose"] .'</h1>
                <h4>'. $_SESSION["jsonTexts"]["lose"]["dont_worry"] .'</h4>
                <span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["lose"]["lose_first_text"] .'</a></span>'; ?>
                <button id="save-score">Guardar dades</button>
                <form id="save-score-form" method="post" style="display: none">
                    <label for="player_name">Nom del jugador:</label>
                    <input type="text" id="player_name" name="player_name">
                    <input type="hidden" id="score" name="score" value="18">
                    <input type="submit" value="Envia">
                </form>
            </section>
        </section>
    </main>
    <script src="lose_controller.js"></script>
</body>
</html>