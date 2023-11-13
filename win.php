<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Has guanyat!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main id="main-win" class="d-none">
        <?php
        session_start();
        if (!isset($_POST["game_won"])) {
            echo "<section id='bad-win'><h1>". $_SESSION["jsonTexts"]["win"]["win_bad_ending"] ."</h1>";
            echo '<span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["win"]["go_start"] .'</a><span>👈</span></span><section>';
            header('HTTP/1.0 403 Forbidden');
        } elseif (isset($_POST["player_name"])) {
            save_score();
            echo '<section class="win-after">
                    <h1>'. $_SESSION["jsonTexts"]["win"]["win_second_title"] .'!</h1>
                        <svg id="money-svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                            <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                            <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                            <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                            <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                        </svg>
                        <span class="score-span">'.$_SESSION["jsonTexts"]["win"]["score"].' '.$_POST["final_score"].'</span>
                        <span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["win"]["go_start"] .'</a></span><section>
                        <span class="saved-span">'. $_SESSION["jsonTexts"]["win"]["save_msg"] .'</span>
                    </section>';
        } else {
            echo '
                <section class="win-before">
                    <h1>'. $_SESSION["jsonTexts"]["win"]["win_first_title"] .'</h1>
                    <h3>'. $_SESSION["jsonTexts"]["win"]["win_first_text"] .'</h3>

                    <button id="win-transition">'. $_SESSION["jsonTexts"]["win"]["win_button"] .'</button>
                </section>

                <section class="win-after" style="display: none;">
                    <h1>'. $_SESSION["jsonTexts"]["win"]["win_second_title"] .'</h1>
                    <svg id="money-svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                        <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                        <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                        <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                        <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                    </svg>
                    <span class="score-span">'.$_SESSION["jsonTexts"]["win"]["score"].' '.$_POST["final_score"].'</span>
                    <span class="tornar"><a href="http://localhost:8080">'. $_SESSION["jsonTexts"]["win"]["go_start"] .'</a></span><section>
                    <button id="save-score">'. $_SESSION["jsonTexts"]["win"]["save_data"] .'</button>
                    <form id="save-score-form" method="post" style="display: none">
                        <label for="player_name">'. $_SESSION["jsonTexts"]["win"]["player_name"] .'</label>
                        <input type="text" id="player_name" name="player_name">
                        <input type="hidden" id="final_score" name="final_score" value="'.$_POST["final_score"].'">
                        <input type="hidden" name="game_won" value="1">
                        <input type="submit" value="'. $_SESSION["jsonTexts"]["win"]["send_data"] .'">
                    </form>
                </section>
            ';  
        }
        function save_score() {
            session_regenerate_id();
            $file = 'scores.txt';
            $data = file_get_contents($file);
            $data .= session_id().";".$_POST["player_name"].";18;".$_POST["final_score"].";\n";
            file_put_contents($file, $data);
        }
    ?>
    </main>
    <noscript>
        <div class="disabled-script">
            <h2><?php echo $_SESSION["jsonTexts"]["script_disabled"] ?></h2>
        </div>
    </noscript>
    <script src="win_controller.js"></script>
</body>
</html>