<?php
declare(strict_types=1);

// Autoload
require 'Classes/Autoloader.php';
Autoloader::register();

// Version JSON -> Outdated
// use Data\Dataloader;
// $data = new Dataloader("Classes/Data/questions.json");


// Version BD
use Data\DataBase;
$data = new DataBase();

//Get instances of questions
$q = $data->load();
$questions = Factory::createQuestions($q);
?>

<!doctype html>
<html>
<head>
<title>Quiz</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php


function answer_text($q, $v) {
    global $question_correct, $score_total, $score_correct;
    $score_total += $q["score"];
    if (empty($v)) return;
    if ($q["answer"] == $v) {
        $question_correct += 1;
        $score_correct += $q["score"];
        echo "<p> ✔️";
    }else{
        echo "<p> ❌";
    }
}

function answer_radio($q, $v) {
    global $question_correct, $score_total, $score_correct;
    $score_total += $q["score"];
    if (is_null($v)) return;
    if ($q["answer"] == $v) {
        $question_correct += 1;
        $score_correct += $q["score"];
        echo "<p> ✔️";
    }else{
        echo "<p> ❌";
    }
}


function answer_checkbox($q, $v) {
    global $question_correct, $score_total, $score_correct;
    $score_total += $q["score"];
    if (is_null($v)) return;
    $diff1 = array_diff($q["answer"], $v);
    $diff2 = array_diff($v, $q["answer"]);
    if (count($diff1) == 0 && count($diff2) == 0) {
        $question_correct += 1;
        $score_correct += $q["score"];
        echo "<p> ✔️";
    }else{
        echo "<p> ❌";
    }
}

$answer_handlers = array(
    "text" => "answer_text",
    "radio" => "answer_radio",
    "checkbox" => "answer_checkbox"
);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    foreach ($questions as $q) {
        echo $q->render();
    }
} else {
    $question_total = 0;
    $question_correct = 0;
    $score_total = 0;
    $score_correct = 0;
    foreach ($questions as $q) {
        $question_total += 1;
        echo "<h2>". $q["text"] . "</h2>";
        $answer_handlers[$q["type"]]($q, $_POST[$q["name"]] ?? NULL);
        if (is_null($_POST[$q["name"]] ?? NULL) || empty($_POST[$q["name"]] ?? NULL)) {
            echo "<p>Vous n'avez pas répondu à cette question</p>";
            continue;
        }else{
            if (is_array($_POST[$q["name"]])) {
                echo " Vous avez choisi <strong>";
                foreach ($_POST[$q["name"]] as $value) {
                    echo $value . " ";
                }
                echo "</strong> pour réponse</p>";
            } else {
                echo " Vous avez choisi <strong>" . $_POST[$q["name"]] . "</strong> pour réponse</p>";
            }
        }
    }
    echo "<p>Reponses correctes: <strong>" . $question_correct . "/" . $question_total . "</strong></p>";
    echo "<p>Votre score: <strong>" . $score_correct . "/" . $score_total . "</strong></p>";
    echo "<a href=''>Recommencer</a>";
}
?>
</body>
</html>

