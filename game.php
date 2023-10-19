<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $file = fopen("preguntes/catalan_1.txt", "r");
        $question_prefix = "* ";
        $correct_answer_prefix = "+ ";
        $wrong_answer_prefix = "- ";
        $questions_array = [];
        $question = "";
        $question_answers = [];

        $questions_amount = 3;
        $selected_indexes = [];
        while (true) {
            $file_content = fgets($file);
            if ($file_content) {
                if (str_starts_with($file_content, $question_prefix)) {
                    if (count($question_answers) != 0) {
                        array_push($questions_array, array($question => $question_answers));
                    }
                    $question = $file_content;
                } else {
                    array_push($question_answers, $file_content);
                }
            } else {
                break;
            }
        }

        for ($i = 1; $i <= $questions_amount; $i++) {
            while (true) {
                $index = rand(0, count($questions_array)-1);
                if (!in_array($index, $selected_indexes)) {
                    array_push($selected_indexes, $index);
                    break;
                }
            }
        }

        echo var_dump($questions_array[$selected_indexes[0]]);
    ?>
</body>
</html>