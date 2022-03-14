<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">

    <style>
        .container-left {
            padding: 32px;
        }
    </style>
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <div class="container-left">
        <h2 style="margin-bottom: 8px;">Wort hinzufügen</h2>

        <?php
        $allowed_letters = "abcdefghijklmnopqrstuvwxyzöäü";
        $word_to_add = strtolower($_GET['word']);
        $word_list = file_get_contents('words.txt');

        if (strlen($word_to_add) !== 5) {
            echo "Das Wort <b>$word_to_add</b> hat nicht 5 Buchstaben";
            return;
        }

        $word_array = str_split($word_to_add);
        foreach ($word_array as $letter) {
            if (!str_contains($allowed_letters, $letter)) {
                echo "Der Buchstabe <b>$letter</b> ist nicht erlaubt!";
                return;
            }
        }

        if (!str_contains(strtolower($word_list), $word_to_add)) {
            $word_list .= "\n$word_to_add";
            file_put_contents('words.txt', $word_list);
            echo "Das Wort <b>$word_to_add</b> wurde hinzugefügt.";
        } else {
            echo "Das Wort <b>$word_to_add</b> existiert bereits in der Liste.";
        }

        echo '<br><br><button class="button" onclick="window.location.href=\'index.php\';">Zurück</button><br><br>';
        ?>
    </div>
</body>

</html>