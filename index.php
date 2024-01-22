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
<link rel="stylesheet" href="./static/css/index.css">
</head>
<body>
<?php


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $question_number = 1;
    echo "<h1> Testez votre culture avec ce quiz! </h1>";
    echo "<form method='POST'>";
    foreach ($questions as $q) {
        echo $question_number.". ".$q->render();
        echo "<br>";
        $question_number++;
    }
    echo "<input type='submit' value='Submit Answers'>";
    echo "</form>";
} else {
    $question_total = 0;
    $question_correct = 0;
    $score_total = 0;
    $score_correct = 0;
    foreach ($questions as $q) {
        $question_total += 1;
        $score_total += $q->getScore();
        $score = $q->checkAnswer($_POST[$q->getId()]);
        if ($score > 0){
            $score_correct+=$score;
            $question_correct += 1;
        }
    }
    echo "<p>Reponses correctes: <strong>" . $question_correct . "/" . $question_total . "</strong></p>";
    echo "<p>Votre score: <strong>" . $score_correct . "/" . $score_total . "</strong></p>";
    echo "<a href=''>Recommencer</a>";
}
?>
</body>
</html>

