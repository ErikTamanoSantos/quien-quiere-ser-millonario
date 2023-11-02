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
        <?php 
        session_start();
        if (isset($_POST["player_name"])) {
            save_score();
            echo '<section class="second-lose" style="display: block">
                <section class="fixed-lose">
                    <h1>'. $_SESSION["jsonTexts"]["lose"]["you_lose"] .'</h1>
                    <h4>'. $_SESSION["jsonTexts"]["lose"]["dont_worry"] .'</h4>
                    <span class="score-span">'.$_SESSION["jsonTexts"]["lose"]["score"].' '.$_POST["final_score"].'</span>
                    <span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["lose"]["lose_first_text"] .'</a></span>
                    <span class="saved-span">'. $_SESSION["jsonTexts"]["lose"]["save_msg"] .'</span>
                </section>
            </section>';
        } else {
            echo '<section class="first-lose">
                <h1>'. $_SESSION["jsonTexts"]["lose"]["you_failed"] .'</h1>
                <h4>'. $_SESSION["jsonTexts"]["lose"]["you_know"] .'</h4>
                <button>'. $_SESSION["jsonTexts"]["lose"]["lose_next_button"] .'</button>
            </section>

            <section class="second-lose">
                <section class="fixed-lose">
                    <h1>'. $_SESSION["jsonTexts"]["lose"]["you_lose"] .'</h1>
                    <h4>'. $_SESSION["jsonTexts"]["lose"]["dont_worry"] .'</h4>
                    <span class="score-span">'.$_SESSION["jsonTexts"]["lose"]["score"].' '.$_POST["final_score"].'</span>
                    <span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["lose"]["lose_first_text"] .'</a></span>
                    <button onclick="showSaveScoreForm()" id="save-score">'. $_SESSION["jsonTexts"]["lose"]["save_data"] .'</button>
                    <form id="save-score-form" method="post" style="display: none">
                        <label for="player_name">'. $_SESSION["jsonTexts"]["lose"]["player_name"] .'</label>
                        <input type="text" id="player_name" name="player_name">
                        <input type="hidden" id="final_score" name="final_score" value="'.$_POST["final_score"].'">
                        <input type="hidden" id="correct_answers" name="correct_answers" value="'.$_POST["correct_answers"].'">
                        <input type="submit" value="'. $_SESSION["jsonTexts"]["lose"]["send_data"] .'">
                    </form>
                </section>
            </section>';

            
        }
        function save_score() {
            session_regenerate_id();
            $file = 'scores.txt';
            $data = file_get_contents($file);
            $data .= session_id().";".$_POST["player_name"].";".$_POST["correct_answers"].";".$_POST["final_score"].";\n";
            file_put_contents($file, $data);
        }
        ?>
    </main>
    <script src="lose_controller.js"></script>
</body>
</html>