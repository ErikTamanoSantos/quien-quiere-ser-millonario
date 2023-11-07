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
    <form class="d-none" id="lose_form" action="lose.php" method="POST">
        <input type="hidden" name="final_score" id="lose_final_score" value="0">
        <input type="hidden" name="correct_answers" id="lose_correct_answers" value="0">
        <input type="hidden" name="game_lost" id="game_lost" value="1">
        <input type="hidden" name="reason" id="reason" value="">
    </form>
    <nav class="game-info d-none">
        <?php    
            session_start();
            if (isset($_POST['cur_level'])) {
                $_SESSION['cur_level'] = $_POST['cur_level'];
            } else {
                $_SESSION['cur_level'] = 1;
            }
            $gameLang;
            if (!isset($_SESSION["idioma"]))  { $gameLang = "catalan"; }
            if ($_SESSION["idioma"] === "ca") { $gameLang = "catalan"; }
            if ($_SESSION["idioma"] === "es") { $gameLang = "spanish"; }
            if ($_SESSION["idioma"] === "en") { $gameLang = "english"; }
            if (isset($_POST['clock'])) { echo '<span id="reloj">'. $_POST['clock'] .'</span>'; } 
            else { echo '<span id="reloj">0:00</span>'; }
        ?>

        <span class="comodines">
            <button class="fifty" <?php echo "fifty". ((isset($_SESSION["50-disabled"]) and $_SESSION["50-disabled"] == 1) ? " disabled" : ""); ?>><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.8949 22.1193C20.2926 22.1193 19.7557 22.0085 19.2841 21.7869C18.8153 21.5653 18.4432 21.2599 18.1676 20.8707C17.892 20.4815 17.7486 20.0355 17.7372 19.5327H19.527C19.5469 19.8707 19.6889 20.1449 19.9531 20.3551C20.2173 20.5653 20.5312 20.6705 20.8949 20.6705C21.1847 20.6705 21.4403 20.6065 21.6619 20.4787C21.8864 20.348 22.0611 20.1676 22.1861 19.9375C22.3139 19.7045 22.3778 19.4375 22.3778 19.1364C22.3778 18.8295 22.3125 18.5597 22.1818 18.3267C22.054 18.0937 21.8764 17.9119 21.6491 17.7812C21.4219 17.6506 21.1619 17.5838 20.8693 17.581C20.6136 17.581 20.3651 17.6335 20.1236 17.7386C19.8849 17.8437 19.6989 17.9872 19.5653 18.169L17.9247 17.875L18.3381 13.2727H23.6733V14.7812H19.8594L19.6335 16.9673H19.6847C19.8381 16.7514 20.0696 16.5724 20.3793 16.4304C20.6889 16.2884 21.0355 16.2173 21.419 16.2173C21.9446 16.2173 22.4134 16.3409 22.8253 16.5881C23.2372 16.8352 23.5625 17.1747 23.8011 17.6065C24.0398 18.0355 24.1577 18.5298 24.1548 19.0895C24.1577 19.6776 24.0213 20.2003 23.7457 20.6577C23.473 21.1122 23.0909 21.4702 22.5994 21.7315C22.1108 21.9901 21.5426 22.1193 20.8949 22.1193ZM28.8636 22.1918C28.1307 22.1889 27.5 22.0085 26.9716 21.6506C26.446 21.2926 26.0412 20.7741 25.7571 20.0952C25.4759 19.4162 25.3366 18.5994 25.3395 17.6449C25.3395 16.6932 25.4801 15.8821 25.7614 15.2116C26.0455 14.5412 26.4503 14.0312 26.9759 13.6818C27.5043 13.3295 28.1335 13.1534 28.8636 13.1534C29.5938 13.1534 30.2216 13.3295 30.7472 13.6818C31.2756 14.0341 31.6818 14.5455 31.9659 15.2159C32.25 15.8835 32.3906 16.6932 32.3878 17.6449C32.3878 18.6023 32.2457 19.4205 31.9616 20.0994C31.6804 20.7784 31.277 21.2969 30.7514 21.6548C30.2259 22.0128 29.5966 22.1918 28.8636 22.1918ZM28.8636 20.6619C29.3636 20.6619 29.7628 20.4105 30.0611 19.9077C30.3594 19.4048 30.5071 18.6506 30.5043 17.6449C30.5043 16.983 30.4361 16.4318 30.2997 15.9915C30.1662 15.5511 29.9759 15.2202 29.7287 14.9986C29.4844 14.777 29.196 14.6662 28.8636 14.6662C28.3665 14.6662 27.9688 14.9148 27.6705 15.4119C27.3722 15.9091 27.2216 16.6534 27.2188 17.6449C27.2188 18.3153 27.2855 18.875 27.419 19.3239C27.5554 19.7699 27.7472 20.1051 27.9943 20.3295C28.2415 20.5511 28.5312 20.6619 28.8636 20.6619ZM20.8949 37.1193C20.2926 37.1193 19.7557 37.0085 19.2841 36.7869C18.8153 36.5653 18.4432 36.2599 18.1676 35.8707C17.892 35.4815 17.7486 35.0355 17.7372 34.5327H19.527C19.5469 34.8707 19.6889 35.1449 19.9531 35.3551C20.2173 35.5653 20.5312 35.6705 20.8949 35.6705C21.1847 35.6705 21.4403 35.6065 21.6619 35.4787C21.8864 35.348 22.0611 35.1676 22.1861 34.9375C22.3139 34.7045 22.3778 34.4375 22.3778 34.1364C22.3778 33.8295 22.3125 33.5597 22.1818 33.3267C22.054 33.0937 21.8764 32.9119 21.6491 32.7812C21.4219 32.6506 21.1619 32.5838 20.8693 32.581C20.6136 32.581 20.3651 32.6335 20.1236 32.7386C19.8849 32.8437 19.6989 32.9872 19.5653 33.169L17.9247 32.875L18.3381 28.2727H23.6733V29.7812H19.8594L19.6335 31.9673H19.6847C19.8381 31.7514 20.0696 31.5724 20.3793 31.4304C20.6889 31.2884 21.0355 31.2173 21.419 31.2173C21.9446 31.2173 22.4134 31.3409 22.8253 31.5881C23.2372 31.8352 23.5625 32.1747 23.8011 32.6065C24.0398 33.0355 24.1577 33.5298 24.1548 34.0895C24.1577 34.6776 24.0213 35.2003 23.7457 35.6577C23.473 36.1122 23.0909 36.4702 22.5994 36.7315C22.1108 36.9901 21.5426 37.1193 20.8949 37.1193ZM28.8636 37.1918C28.1307 37.1889 27.5 37.0085 26.9716 36.6506C26.446 36.2926 26.0412 35.7741 25.7571 35.0952C25.4759 34.4162 25.3366 33.5994 25.3395 32.6449C25.3395 31.6932 25.4801 30.8821 25.7614 30.2116C26.0455 29.5412 26.4503 29.0312 26.9759 28.6818C27.5043 28.3295 28.1335 28.1534 28.8636 28.1534C29.5938 28.1534 30.2216 28.3295 30.7472 28.6818C31.2756 29.0341 31.6818 29.5455 31.9659 30.2159C32.25 30.8835 32.3906 31.6932 32.3878 32.6449C32.3878 33.6023 32.2457 34.4205 31.9616 35.0994C31.6804 35.7784 31.277 36.2969 30.7514 36.6548C30.2259 37.0128 29.5966 37.1918 28.8636 37.1918ZM28.8636 35.6619C29.3636 35.6619 29.7628 35.4105 30.0611 34.9077C30.3594 34.4048 30.5071 33.6506 30.5043 32.6449C30.5043 31.983 30.4361 31.4318 30.2997 30.9915C30.1662 30.5511 29.9759 30.2202 29.7287 29.9986C29.4844 29.777 29.196 29.6662 28.8636 29.6662C28.3665 29.6662 27.9688 29.9148 27.6705 30.4119C27.3722 30.9091 27.2216 31.6534 27.2188 32.6449C27.2188 33.3153 27.2855 33.875 27.419 34.3239C27.5554 34.7699 27.7472 35.1051 27.9943 35.3295C28.2415 35.5511 28.5312 35.6619 28.8636 35.6619Z" fill="#D4D8F0"/><line x1="13" y1="25.25" x2="38" y2="25.25" stroke="#D4D8F0" stroke-width="1.5"/><circle cx="25" cy="25" r="23.5" stroke="#D4D8F0" stroke-width="3"/></svg></button>
            <button class="add-time <?php echo ($_SESSION["cur_level"] == 1 ? "unavailable" : "") ?> " <?php echo "add-time". (((isset($_SESSION["add-time-disabled"]) and $_SESSION["add-time-disabled"] == 1) or $_SESSION["cur_level"] == 1) ? " disabled" : ""); ?>><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_16_9)"><path d="M25 48.5C37.9787 48.5 48.5 37.9787 48.5 25C48.5 12.0213 37.9787 1.5 25 1.5C12.0213 1.5 1.5 12.0213 1.5 25C1.5 37.9787 12.0213 48.5 25 48.5Z" stroke="#D4D8F0" stroke-width="3"/><path d="M17.9167 25.25C17.9167 26.7274 18.2077 28.1903 18.773 29.5552C19.3384 30.9201 20.1671 32.1603 21.2117 33.205C22.2564 34.2496 23.4966 35.0783 24.8615 35.6436C26.2264 36.209 27.6893 36.5 29.1667 36.5C30.644 36.5 32.1069 36.209 33.4719 35.6436C34.8368 35.0783 36.077 34.2496 37.1216 33.205C38.1663 32.1603 38.995 30.9201 39.5603 29.5552C40.1257 28.1903 40.4167 26.7274 40.4167 25.25C40.4167 23.7726 40.1257 22.3097 39.5603 20.9448C38.995 19.5799 38.1663 18.3397 37.1216 17.295C36.077 16.2504 34.8368 15.4217 33.4719 14.8564C32.1069 14.291 30.644 14 29.1667 14C27.6893 14 26.2264 14.291 24.8615 14.8564C23.4966 15.4217 22.2564 16.2504 21.2117 17.295C20.1671 18.3397 19.3384 19.5799 18.773 20.9448C18.2077 22.3097 17.9167 23.7726 17.9167 25.25Z" stroke="#D4D8F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M29.1667 25.25L32.9167 27.75" stroke="#D4D8F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M29.1667 19V25.25" stroke="#D4D8F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.9167 22.0835V27.9168" stroke="#D4D8F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 25H14.8333" stroke="#D4D8F0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_16_9"><rect width="50" height="50" fill="white"/></clipPath></defs></svg></button>
            <button class="public" <?php echo "public". ((isset($_SESSION["public-disabled"]) and $_SESSION["public-disabled"] == 1) ? " disabled" : ""); ?>><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_16_19)"><path d="M25 48.5C37.9787 48.5 48.5 37.9787 48.5 25C48.5 12.0213 37.9787 1.5 25 1.5C12.0213 1.5 1.5 12.0213 1.5 25C1.5 37.9787 12.0213 48.5 25 48.5Z" stroke="#D4D8F0" stroke-width="3"/><path d="M25 15C25.9889 15 26.9556 15.2932 27.7779 15.8427C28.6001 16.3921 29.241 17.173 29.6194 18.0866C29.9978 19.0002 30.0969 20.0055 29.9039 20.9755C29.711 21.9454 29.2348 22.8363 28.5355 23.5355C27.8363 24.2348 26.9454 24.711 25.9755 24.9039C25.0055 25.0969 24.0002 24.9978 23.0866 24.6194C22.173 24.241 21.3921 23.6001 20.8427 22.7779C20.2932 21.9556 20 20.9889 20 20L20.005 19.783C20.0609 18.4958 20.6116 17.2798 21.5422 16.3887C22.4728 15.4975 23.7115 15.0001 25 15Z" fill="#D4D8F0"/><path d="M27 27C28.3261 27 29.5979 27.5268 30.5355 28.4645C31.4732 29.4021 32 30.6739 32 32V33C32 33.5304 31.7893 34.0391 31.4142 34.4142C31.0391 34.7893 30.5304 35 30 35H20C19.4696 35 18.9609 34.7893 18.5858 34.4142C18.2107 34.0391 18 33.5304 18 33V32C18 30.6739 18.5268 29.4021 19.4645 28.4645C20.4021 27.5268 21.6739 27 23 27H27Z" fill="#D4D8F0"/></g><defs><clipPath id="clip0_16_19"><rect width="50" height="50" fill="white"/></clipPath></defs></svg> </button>
        </span>

        <?php
        
            echo '<span id="cur_level" value="'.(!isset($_SESSION['cur_level']) ? '1' : $_SESSION['cur_level']).'">'. (!isset($_SESSION['cur_level']) ? $_SESSION["jsonTexts"]["game"]['cur_level'].'1' : $_SESSION["jsonTexts"]["game"]['cur_level'].$_SESSION['cur_level']) .'</span>';
        ?>
    </nav>
    <main class="main-slider d-none">
        <section class="modal spectators-modal">
                <div class="modal-content spectators-content">
                    <h3>El publico está votando...</h3>
                    <div id="spectators-chart"></div>
                </div>
        </section>
        <?php 
        //echo $_SESSION['cur_level'];
        //$_SESSION["idioma"] == "ca" ? "catalan" : ($_SESSION["idioma"] == "es" ? "spanish" : "english")
        
        $file = fopen("preguntes/".$gameLang."_".$_SESSION['cur_level'].".txt", "r");
        $file_dup = fopen("preguntes/".$gameLang."_".$_SESSION['cur_level'].".txt", "r");
        $eng_file = fopen("preguntes/english_".$_SESSION['cur_level'].".txt", "r");
        $question_prefix = "* ";
        $correct_answer_prefix = "+ ";
        $wrong_answer_prefix = "- ";
        $questions_array = [];

        $questions_amount = 3;
        $max_level = 6;
        $selected_indexes = [];

        $questions_array = get_questions_from_file($file, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix);
        $images_array = get_images_array($file_dup, $eng_file, $question_prefix);
        $selected_indexes = get_array_of_random_numbers($questions_amount, 0, count($questions_array)-1);

        print_page_from_data($questions_array, $images_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix, $max_level);

        
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
                        if (trim(strlen($file_content)) > 1) {
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

        function print_page_from_data($questions_array, $images_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix, $max_level) {
            $question = key($questions_array[$selected_indexes[0]]);
            echo "<div id='question-0' class='question-container slider' question-number='0'>\n";
            if ($images_array[$question]) {
                echo "<img src='imgs/fotos_preguntas/".$_SESSION["cur_level"]."/".$images_array[$question]."'>";
            }
            echo "<div class='question-inner-container'>";
            echo "<div class='timer "; 
            if ($_SESSION["cur_level"] == 1) {
                echo "d-none";
            }
            echo "'>";
            echo "<h2 class='timer-tag'>Temps Restant:</h2>";
            echo "<h2 class='question-timer'>60</h2>";
            echo "</div>";
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
            echo "</div>";
            echo "</div>\n";

            for ($i = 1; $i < count($selected_indexes); $i++) {
                $question = key($questions_array[$selected_indexes[$i]]);
                echo "<div id='question-$i' class='question-container hidden-question slider' question-number='$i'>\n";
                if ($images_array[$question]) {
                    echo "<img src='imgs/fotos_preguntas/".$_SESSION["cur_level"]."/".$images_array[$question]."'>";
                }
                echo "<div class='question-inner-container'>";
                echo "<div class='timer "; 
                if ($_SESSION["cur_level"] == 1) {
                    echo "d-none";
                }
                echo "'>";
                echo "<h2 class='timer-tag'>Temps Restant:</h2>";
                echo "<h2 class='question-timer'>60</h2>";
                echo "</div>";
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
                echo "</div>";
                echo "</div>\n";
            }
            if ($_SESSION['cur_level'] == $max_level) {
                echo "<form method='POST' id='next-level-container' class='d-none slider' action='win.php'>";
                echo "<input type='hidden' id='game_won' name='game_won' value='1'>";
                echo "<input type='hidden' id='final_score' name='final_score' value='0'>";
            } else {
                echo "<form method='POST' id='next-level-container' class='d-none slider' action='game.php'>";
            }
            echo "<h1>". $_SESSION["jsonTexts"]["game"]["level_completed"] ."</h1>";
            echo "<input type='submit' value='". $_SESSION["jsonTexts"]["game"]["next_level"] ."'>";
            $next_level = $_SESSION['cur_level']+1;
            echo "<input type='hidden' name='clock' value=''>";
            echo "<input type='hidden' name='50-disabled' value='0'>";
            echo "<input type='hidden' name='add-time-disabled' value='0'>";
            echo "<input type='hidden' name='public-disabled' value='0'>";
            echo "<input type='hidden' name='cur_level' value='".$next_level."'>";
            echo "</form>";
        }

        function get_images_array($file, $eng_file, $question_prefix) {
            $images_array = [];
            while (true) {
                $file_content = fgets($file);
                $eng_file_content = fgets($eng_file);
                if ($file_content) {
                    if (str_starts_with($file_content, $question_prefix)) {
                        
                        $dir = new DirectoryIterator(dirname("imgs/fotos_preguntas/".$_SESSION["cur_level"]."/*"));
                        
                        foreach ($dir as $fileinfo) {
                            if (!$fileinfo->isDot()) {
                                $imageName = $fileinfo->getFilename();
                                if (str_contains($eng_file_content, explode(".", $imageName)[0])) {
                                    $images_array[$file_content] = $imageName;
                                }
                            }
                        }
                    }
                } else {
                    return $images_array;
                }
            }
        }
    ?>
    </main>
    <noscript>
        <div class="disabled-script">
            <h2><?php echo $_SESSION["jsonTexts"]["script_disabled"] ?></h2>
        </div>
    </noscript>
</body>
</html>