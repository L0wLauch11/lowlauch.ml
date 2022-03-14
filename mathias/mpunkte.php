<!DOCTYPE html>
<html>

<head>
    <title>m punkte</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">
    <link rel="stylesheet" href="mpunkte.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
        <script src="triggeraddmpunkt.js"></script>
    </header>

    <div id="container">
        <h1>m punkte aka. m's</h1>

        <?php

        $dir = new DirectoryIterator('mpunkte');

        echo '<ul id="mpunkte-list">';
        // A database would be way more practical for this application
        // but i don't want to bother with that shit
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();

                // Read file and get m punkte
                $file = new SplFileObject("mpunkte/$filename");

                $entry = array();
                while (!$file->eof()) {
                    $entry[] = $file->fgets();
                }
                echo
                "<li>
                    <p>
                        <span class='name'>${entry[0]}</span>
                        <span class='points'>
                            ${entry[1]}
                            <button onclick='addMpunkt(\"$filename\", 1)' class='button'>+</button>
                            <button onclick='addMpunkt(\"$filename\", -1)' class='button'>-</button>
                        </span>
                        
                        <div style='clear: both;'></div>
                    </p>
                </li>";

                $file = null;
                
            }
        }

        echo "
        <li>
            <form action='addperson.php'>
                <input class='textbox' name='name' type='text' value='Person'>
                <input class='button' type='submit' value='✔'><br><br>
            </form>
        </li>
        ";

        echo '</ul>';

        ?>

    </div>
</body>

</html>