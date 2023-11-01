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
                <?php echo '<button onclick="showSaveScoreForm()" id="save-score">'. $_SESSION["jsonTexts"]["lose"]["save_data"] .'</button>
                <form id="save-score-form" method="post" style="display: none">
                    <label for="player_name">'. $_SESSION["jsonTexts"]["lose"]["player_name"] .'</label>
                    <input type="text" id="player_name" name="player_name">
                    <input type="hidden" id="final_score" name="final_score" value="'.$_POST["final_score"].'">
                    <input type="submit" value="'. $_SESSION["jsonTexts"]["lose"]["send_data"] .'">
                </form>'; ?>
            </section>
        </section>
    </main>
    <script src="lose_controller.js"></script>
</body>
</html>