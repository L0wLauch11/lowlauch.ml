<!DOCTYPE html>
<html>

<head>
    <title>temp file uploads</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <main>
        <div id="container">
            <h1>Temporäre Datei Uploads</h1><br>

            <div class="subcontainer" style="text-align: center; display: block; margin-left: auto; margin-right: auto;">
                <h2>Datei hochladen</h2>
                <p>Dateien verschwinden nach 24 Stunden</p>

                <form enctype="multipart/form-data" action="uploadtempfile.php" method="POST">
                    <input type="hidden" name="MAX_FILE_SIZE" value="107400000000"> <!-- Max filesize: 100GB -->
                    Datei: <input class="button" name="userfile" type="file"><br><br>
                    <input class="button" name="submit" type="submit" value="Hochladen"><br><br>
                </form>
            </div>
        </div>
    </main>
</body>

</html>