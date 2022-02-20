<!DOCTYPE html>
<html>

<head>
    <title>Wordle</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
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

    <div id="container">
        <h1 id="title">Wordle</h1>

        <!-- Game board -->
        <?php

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
        $allowed_keys = "QWERTZUIOPÜASDFGHJKLÖÄYXCVBNM<";
        print "\n\n\t\t<!-- Keyboard -->\n\t\t<br><div id='keyboard'>";
        for ($i = 0; $i < strlen($allowed_keys); $i++) {
            $key = utf8_encode(substr($allowed_keys, $i, 1));
            if($key == "_") {
                print '<div></div>'; // empty div works better as <br> for some reason
            } else {
                print "<button class='deselected' id='$key'>$key</button>";
            }
        }
        print '</div>';

        // Generate word
        $words = file('words.txt');
        $length = count($words);

        $i = 0;
        print "\n\n\t\t<!-- Word list -->\n\t\t";
        foreach ($words as $word) {
            $word = str_replace("\r\n", "", $word);
            print "<p class='hidden' id='word$i'>$word</p>";
            $i++;
        }

        print "<p class='hidden' id='wordcount'>$length</p>\n";

        ?>
    </div>

    <!-- Game source -->
    <script src="game.js" type="text/javascript"></script>
</body>

</html>