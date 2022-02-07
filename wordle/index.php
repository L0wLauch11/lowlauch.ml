<!DOCTYPE html>
<html>

<head>
    <title>Wordle</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="https://github.com/L0wLauch11/lowlauch.ml" target="_blank">source</a></li>
                <li><a href="../index.php">homepage</a></li>
                <li><a href="../filemirror.php">file mirror</a></li>
                <li><a href="../basedboard.php">based board</a></li>
                <li><a href="index.php">wordle klon</a></li>
            </ul>
        </nav>
    </header>

    <div id="winPopup" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="text">Du hast gewonnen! Das Wort war:&nbsp;</p>
            <button class="badWordButton">scheiss Wort</button>
            <button class="closeButton">Nochmal</button>
        </div>

    </div>

    <div id="losePopup" class="modal">

        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="text">Du hast verloren! Das Wort war:&nbsp;</p>
            <button class="badWordButton">scheiss Wort</button>
            <button class="closeButton">Nochmal</button>
        </div>

    </div>

    <div id="content">
        <h1 id="title">Wordle</h1>

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
        $allowed_keys = "ABCDEFGHIJKLMNOPQRSTUVWXYZ���<";
        print '<br><div id="keyboard">';
        for ($i = 0; $i < strlen($allowed_keys); $i++) {
            $key = utf8_encode(substr($allowed_keys, $i, 1));
            print "<button class='deselected' id='$key'>$key</p>";
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