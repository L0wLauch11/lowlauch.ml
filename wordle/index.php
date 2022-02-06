<!DOCTYPE html>
<html>

<head>
    <title>Wordle</title>

    <meta charset="utf-8">

    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div id="winPopup" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Du hast gewonnen!</p>
            <button class="badWordButton">scheiss Wort</button>
            <button class="closeButton">Nochmal</button>
        </div>

    </div>

    <div id="losePopup" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="loseText">Du hast verloren! Das Wort war:&nbsp;</p>
            <button class="badWordButton">scheiss Wort</button>
            <button class="closeButton">Nochmal</button>
        </div>

    </div>

    <div id="content">
        <header>
            <h1 id="title">Wordle</h1>
        </header>

        <?php

        // Generate board
        $length = 5;
        $rows = 6;
        $id = 0;

        print '<table id="board">';
        for ($i = 0; $i < $rows; $i++) {
            print '<tr>';

            for ($j = 0; $j < $length; $j++) {
                print "<th id='$id'></th>";
                $id++;
            }

            print '</tr>';
        }
        print '</table>';

        // Generate "keyboard"
        $allowedKeys = "ABCDEFGHIJKLMNOPQRSTUVWXYZÖÄÜ";
        print '<br><div id="keyboard">'; // hide it for now cos it doesnt work >:(
        for ($i = 0; $i < strlen($allowedKeys); $i++) {
            $key = utf8_encode(substr($allowedKeys, $i, 1));

            if ($i == floor(strlen($allowedKeys)/1.75)) {
                print '<br><br>';
            }

            print "<p class='deselected' id='$key'>$key</p>";
        }
        print '</div>';

        // Generate word
        $words = file('words.txt');
        $length = count($words);

        $i = 0;
        foreach ($words as $word) {
            $word = str_replace("\r\n", "", $word);
            print "<p class='hidden' id='word$i'>$word</p>";
            $i++;
        }

        print "<p class='hidden' id='wordcount'>$length</p>";

        ?>
    </div>

    <script src="game.js" type="text/javascript"></script>
</body>

</html>