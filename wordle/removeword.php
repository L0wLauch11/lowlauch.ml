<?php
$word_to_remove = intval($_GET['wordLine']);

$file = file('words.txt');
unset($file[$word_to_remove]);
file_put_contents('words.txt', implode('', $file));
?>