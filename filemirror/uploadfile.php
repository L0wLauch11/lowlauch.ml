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
        <h1>Datei hochladen</h1>

        <?php

        set_time_limit(0);

        if(isset($_POST['submit'])) {
            $password = $_POST['password'];
            $file_hidden = $_POST['hidden'];
            $date_now = date('_d-m-Y H-i-s');

            if ($password != file_get_contents('uploadpassword.txt')) {
                echo 'Falsches Passwort!';
                echo '<br><br><button class="button" onclick="window.location.href=\'filemirror.php\';">Zurück</button>';
                return;
            }

            $uploaddir = $file_hidden ? 'files/hidden/' : 'files/';
            $uploadfile = basename($_FILES['userfile']['name']);

            $uploadfile_seperated = explode('.', $uploadfile);
            $uploadfile_extension = $uploadfile_seperated[array_key_last($uploadfile_seperated)];
            $uploadfile_name = str_replace($uploadfile_extension, '', $uploadfile);

            // Treat duplicate files properly
            if (file_exists($uploaddir . $uploadfile)) {
                $uploadfile = "$uploadfile_name{$date_now}.$uploadfile_extension";
            }

            // Uploading metadata
            if ($uploadfile_extension == 'meta') {
                $uploaddir = 'files/metadata/';
            }

            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile)) {
                $uploadfile_link = $uploaddir . $uploadfile;
                $int_hidden = $file_hidden ? 1 : 0;

                echo '<div class="subcontainer" style="text-align: center; display: block; margin-left: auto; margin-right: auto;">';

                echo "<p>Fertig hochgeladen.</p>
                    <a href='/?download=$uploadfile&hidden=$int_hidden'>Datei Link</a>
                ";

                echo '<br><br><button class="button" onclick="window.location.href=\'filemirror.php\';">Zurück</button></div>';
            } else {
                echo '<p>Upload fehlgeschlagen</p>';
                echo '<pre id=uploadedfile>';
                print_r($_FILES);
                print '</pre>';

                echo '<br><br><button class="button" onclick="window.location.href=\'filemirror.php\';">Zurück</button>';
            }
        } else {
            echo "Datei eventuell zu groß; Maximale Dateigröße: <b>20GB</b>";
        }
        ?>
    </div>
</body>

</html>