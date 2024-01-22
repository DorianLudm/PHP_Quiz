<?php
namespace Action;
global $questions;

$question_handlers = array(
    "text" => "question_text",
    "radio" => "question_radio",
    "checkbox" => "question_checkbox"
);
function question_text($q) {
    echo ($q["text"] . "<br>" . new Text($q["name"]) . "<br>");
}

function question_radio($q) {
    $html = $q["text"] . "<br>";
    $i = 0;
    foreach ($q["choices"] as $c) {
        $i += 1;
        $html .= new Radio($q["name"], false, $c["value"], $q["name"]."-$i");
        $html .= "<label for='$q[name]-$i'>$c[text]</label>";
    }
    echo $html;
}

function question_checkbox($q) {
    $html = $q["text"] . "<br>";
    $i = 0;
    foreach ($q["choices"] as $c) {
        $i += 1;
        $html .= new Checkbox($q["name"]."[]", false, $c["value"], $q["name"]."-$i");
        $html .= "<label for='$q[name]-$i'>$c[text]</label>";
    }
    echo $html;
}

echo "<form method='POST' action=''><ol>";
foreach ($questions as $q) {
    echo "<li>";
    print_r($q);
    $question_handlers[$q["type"]]($q);
}
echo "</ol><input type='submit' value='Envoyer'></form>";

?>