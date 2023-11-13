<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ranking</title>
</head>
<body>
    <main class="d-none">
        <?php
        session_start();
        $data_array = get_data();
        $data_array = sort_data_by_score_descending($data_array);
        render_table($data_array);

        function get_data() {
            $file = fopen("scores.txt", "r");
            $data_array = [];
            $i = 0;
            while ($data = fgets($file)) {
                $data = explode(";", $data);
                $name = $data[1];
                $answers = $data[2];
                $score = $data[3];
                $data_array[$i] = array($name => array("answers" => $answers, "score" => $score));
                $i++;
            }
            return $data_array;
        }

        function sort_data_by_score_descending($data_array) {
            while (true) {
                $all_sorted = true;
                for ($i = 0; $i < count($data_array)-1; $i++) {
                    $key_1 = key($data_array[$i]);
                    $key_2 = key($data_array[$i+1]);
                    if ($data_array[$i][$key_1]['score'] < $data_array[$i+1][$key_2]['score']) {
                        $aux = $data_array[$i];
                        $data_array[$i] = $data_array[$i+1];
                        $data_array[$i+1] = $aux;
                        $all_sorted = false;
                    }
                }
                if ($all_sorted) {
                    break;
                }
            }
            return $data_array;
        }

        function render_table($data) {
            echo "
                <div id='ranking-div'>
                    <h1 id='ranking-title'>Ranking</h1>
                    <table id='ranking-table' cellspacing='0'>
                        <thead>
                            <tr>
                                <th id='name-col'>Nom</th>
                                <th id='answer-col'>Encerts</th>
                                <th  id='score-col'>Puntuació</th>
                            </tr>
                        </thead>
                        <tbody>";
            foreach ($data as $entry) {
                $key = key($entry);
                echo "<tr>
                        <td>".$key."</td>";
                echo "  <td>".$entry[$key]['answers']."</td>";
                echo "  <td>".$entry[$key]['score']."</td>";
            }
            echo "</tbody>
                </table>
                <a href='index.php'>Tornar a l'inici</a>
            </div>";
        }
        ?>
    </main>
    <noscript>
        <div class="disabled-script">
            <h2><?php echo $_SESSION["jsonTexts"]["script_disabled"] ?></h2>
        </div>
    </noscript>
    <script src="ranking_controller.js"></script>
</body>
</html>