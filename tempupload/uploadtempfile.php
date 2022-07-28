<html>
<head>
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

    <div id="container">
        <h1>Temporäre Datei hochladen</h1>

        <?php

        set_time_limit(0);

        if(isset($_POST['submit'])) {
            $date_now = time();
            $uploaddir = "files/$date_now";
            $uploadfile = basename($_FILES['userfile']['name']);

            if (!file_exists("$uploaddir")){
                mkdir("$uploaddir");
            }

            $uploadfile_seperated = explode('.', $uploadfile);
            $uploadfile_extension = $uploadfile_seperated[array_key_last($uploadfile_seperated)];
            $uploadfile_name = str_replace($uploadfile_extension, '', $uploadfile);

            if (move_uploaded_file($_FILES['userfile']['tmp_name'], "$uploaddir/$uploadfile")) {
                $uploadfile_link = "$uploaddir/$uploadfile";
                
                echo '<div class="subcontainer" style="text-align: center; display: block; margin-left: auto; margin-right: auto;">';

                echo "<p>Fertig hochgeladen.</p>
                    <a href='$uploadfile_link'>Datei Link</a>
                ";

                echo '<br><br><button class="button" onclick="window.location.href=\'tempupload.php\';">Zurück</button></div>';
            } else {
                echo '<p>Upload fehlgeschlagen</p>';
                echo '<pre id=uploadedfile>';
                print_r($_FILES);
                echo "$uploaddir/$uploadfile";
                print '</pre>';

                echo '<br><br><button class="button" onclick="window.location.href=\'tempupload.php\';">Zurück</button>';
            }
        } else {
            echo "Datei eventuell zu groß; Maximale Dateigröße: <b>20GB</b>";
        }
        ?>
    </div>
</body>

</html>