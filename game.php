<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src='game_controller.js'></script>
    <title>Document</title>
</head>
<body>
    <main class="main-slider">
    <?php 
        $file = fopen("preguntes/catalan_1.txt", "r");
        $question_prefix = "* ";
        $correct_answer_prefix = "+ ";
        $wrong_answer_prefix = "- ";
        $questions_array = [];

        $questions_amount = 3;
        $selected_indexes = [];

        $questions_array = get_questions_from_file($file, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix);
        $selected_indexes = get_array_of_random_numbers($questions_amount, 0, count($questions_array)-1);

        print_page_from_data($questions_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix);

        
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

        function print_page_from_data($questions_array, $selected_indexes, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix) {
            $question = key($questions_array[$selected_indexes[0]]);
            echo "<div id='question-0' class='question-container slider' question-number='0'>";
            echo "<div class='question-header'>";
            echo "<h1>".remove_prefix($question, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</h1>";
            echo "</div>";
            echo "<div class='answer-container'>";
            for ($i = 0; $i < count($questions_array[$selected_indexes[0]][$question]); $i++) {
                $answer = $questions_array[$selected_indexes[0]][$question][$i];
                if (str_starts_with($answer, $correct_answer_prefix)) {
                    echo "<button class='correct-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>";
                } else {
                    echo "<button class='wrong-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>";
                }
            }
            echo "</div>";
            echo "</div>";

            for ($i = 1; $i < count($selected_indexes); $i++) {
                $question = key($questions_array[$selected_indexes[$i]]);
                echo "<div id='question-$i' class='question-container hidden-question slider' question-number='$i'>";
                echo "<div class='question-header'>";
                echo "<h1>".remove_prefix($question, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</h1>";
                echo "</div>";
                echo "<div class='answer-container'>";
                for ($j = 0; $j < count($questions_array[$selected_indexes[$i]][$question]); $j++) {
                    $answer = $questions_array[$selected_indexes[$i]][$question][$j];
                    if (str_starts_with($answer, $correct_answer_prefix)) {
                        echo "<button class='correct-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>";
                    } else {
                        echo "<button class='wrong-button'>".remove_prefix($answer, $question_prefix, $correct_answer_prefix, $wrong_answer_prefix)."</button>";
                    }
                }
                echo "</div>";
                echo "</div>";
            }
        }
    ?>
    </main>
</body>
</html>