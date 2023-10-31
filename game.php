<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src='game_controller.js'></script>
    <title>Document</title>
</head>
<body>
    <nav class="game-info">
        <?php    
            if (isset($_POST['clock'])) { echo '<span id="reloj">'. $_POST['clock'] .'</span>'; } 
            else { echo '<span id="reloj">0:00</span>'; }
        ?>
    </nav>
    <main class="main-slider">
        <?php 
        session_start();
        $gameLang;
        if (isset($_POST['cur_level'])) {
            $_SESSION['cur_level'] = $_POST['cur_level'];
        } else {
            $_SESSION['cur_level'] = 1;
        }
        //echo $_SESSION['cur_level'];
        //$_SESSION["idioma"] == "ca" ? "catalan" : ($_SESSION["idioma"] == "es" ? "spanish" : "english")
        if (!isset($_SESSION["idioma"]))  { $gameLang = "catalan"; }
        if ($_SESSION["idioma"] === "ca") { $gameLang = "catalan"; }
        if ($_SESSION["idioma"] === "es") { $gameLang = "spanish"; }
        if ($_SESSION["idioma"] === "en") { $gameLang = "english"; }
        $file = fopen("preguntes/".$gameLang."_".$_SESSION['cur_level'].".txt", "r");
        $question_prefix = "* ";
        $correct_answer_prefix = "+ ";
        $wrong_answer_prefix = "- ";
        $questions_array = [];

        $questions_amount = 3;
        $max_level = 6;
        $selected_indexes = [];

        $questions_array = get_questions_from_file($file, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix);
        $selected_indexes = get_array_of_random_numbers($questions_amount, 0, count($questions_array)-1);

        print_page_from_data($questions_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix, $max_level);

        
        function get_questions_from_file($file, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix) {
            $question = "";
            $question_answers = [];
            $questions_array = [];

            while (true) {
                $file_content = fgets($file);
                if ($file_content) {
                    if (str_starts_with($file_content, $question_prefix)) {
                        if (count($question_answers) != 0) {
                            array_push($questions_array, array($question => $question_answers));
                        }
                        $question = $file_content;
                        $question_answers = [];
                    } else {
                        if (strlen($file_content) > 1) {
                            array_push($question_answers, $file_content);
                        }
                    }
                } else {
                    return $questions_array;
                }
            }
        }

        function get_array_of_random_numbers($amount, $min, $max) {
            $numbers_array = [];
            for ($i = 1; $i <= $amount; $i++) {
                while (true) {
                    $index = rand(0, $max);
                    if (!in_array($index, $numbers_array)) {
                        array_push($numbers_array, $index);
                        break;
                    }
                }
            }
            return $numbers_array;
        }

        function remove_prefix($text, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix) {
            if (str_starts_with($text, $question_prefix)) {
                return str_replace($question_prefix, "", $text);
            } elseif (str_starts_with($text, $correct_answer_prefix)) {
                return str_replace($correct_answer_prefix, "", $text);
            } else {
                return str_replace($wrong_answer_prefix, "", $text);
            }
        }

        function print_page_from_data($questions_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix, $max_level) {
            $question = key($questions_array[$selected_indexes[0]]);
            echo "<div id='question-0' class='question-container slider' question-number='0'>\n";
            echo "<div class='question-header'>\n";
            echo "<h1>".remove_prefix($question, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</h1>\n";
            echo "</div>\n";
            echo "<div class='answer-container'>\n";
            for ($i = 0; $i < count($questions_array[$selected_indexes[0]][$question]); $i++) {
                $answer = $questions_array[$selected_indexes[0]][$question][$i];
                if (str_starts_with($answer, $correct_answer_prefix)) {
                    echo "<button class='correct-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>\n";
                } else {
                    echo "<button class='wrong-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>\n";
                }
            }
            echo "</div>\n";
            echo "<div class='message-container'>\n";
            echo "<div class='message-correct d-none'>\n";
            echo "<h2>". $_SESSION["jsonTexts"]["game"]["correct"] ."</h2>\n";
            echo "<div class='arrow-container'>\n";
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z" stroke-width="0" fill="currentColor"></path>
                 </svg>';
            echo "</div>\n";
            echo "</div>\n";
            echo "<div class='message-wrong d-none'>\n";
            echo "<h2>". $_SESSION["jsonTexts"]["game"]["wrong"] ."</h2>\n";
            echo "<a href='http://localhost:8080'>". $_SESSION["jsonTexts"]["game"]["go_start"] ."</a>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";

            for ($i = 1; $i < count($selected_indexes); $i++) {
                $question = key($questions_array[$selected_indexes[$i]]);
                echo "<div id='question-$i' class='question-container hidden-question slider' question-number='$i'>\n";
                echo "<div class='question-header'>\n";
                echo "<h1>".remove_prefix($question, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</h1>";
                echo "</div>\n";
                echo "<div class='answer-container'>\n";
                for ($j = 0; $j < count($questions_array[$selected_indexes[$i]][$question]); $j++) {
                    $answer = $questions_array[$selected_indexes[$i]][$question][$j];
                    if (str_starts_with($answer, $correct_answer_prefix)) {
                        echo "<button class='correct-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>\n";
                    } else {
                        echo "<button class='wrong-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>\n";
                    }
                }
                echo "</div>\n";
                echo "<div class='message-container'>\n";
                echo "<div class='message-correct d-none'>\n";
                echo "<h2>Correcte!</h2>\n";
                echo "<div class='arrow-container'>\n";
                echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-down-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z" stroke-width="0" fill="currentColor"></path>
                    </svg>';
                echo "</div>\n";
                echo "</div>\n";
                echo "<div class='message-wrong d-none'>\n";
                echo "<h2>Has fallat!</h2>\n";
                echo "<a href='http://localhost:8080'>TORNAR A L'INICI</a>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
            }
            if ($_SESSION['cur_level'] == $max_level) {
                echo "<form method='POST' id='next-level-container' class='d-none' action='win.php'>";
                echo "<input type='hidden' id='game_won' name='game_won' value='1'>";
            } else {
                echo "<form method='POST' id='next-level-container' class='d-none slider' action='game.php'>";
            }
            echo "<h1>". $_SESSION["jsonTexts"]["game"]["level_completed"] ."</h1>";
            echo "<input type='submit' value='". $_SESSION["jsonTexts"]["game"]["next_level"] ."'>";
            $next_level = $_SESSION['cur_level']+1;
            echo "<input type='hidden' name='clock' value=''>";     //! Aquí está el intento de POST...
            echo "<input type='hidden' name='cur_level' value='".$next_level."'>";
            echo "</form>";
        }
    ?>
    </main>
</body>
</html>