<?php 
declare(strict_types=1);
namespace Action;
$file = file_get_contents('./Data/question.json');

$questions = json_decode($file,true);
?>