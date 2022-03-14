<?php
echo '<br><button class="button" onclick="window.location.href=\'index.php\';">Zurück</button><br><br>';

$allowed_letters = "abcdefghijklmnopqrstuvwxyzöäü";
$word_to_add = $_GET['word'];
$word_list = file_get_contents('words.txt');

if (strlen($word_to_add) != 5) {
    echo "Das Wort <b>$word_to_add</b> hat nicht 5 Buchstaben";
    return;
}

$word_array = explode("", $word_to_add);
foreach ($word_array as $letter)
{
    if (!str_contains($allowed_letters, $letter)) {
        echo "Der Buchstabe ''<b>$letter</b>'' ist nicht erlaubt!";
        return;
    }
}

if (!str_contains(strtolower($word_list), strtolower($word_to_add))) {
    $word_list .= "\n$word_to_add";
    file_put_contents('words.txt', $word_list);
    echo "Das Wort <b>$word_to_add</b> wurde hinzugefügt.";
} else {
    echo "Das Wort <b>$word_to_add</b> existiert bereits in der Liste.";
}
?> 