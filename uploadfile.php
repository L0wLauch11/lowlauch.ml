<html>
<header>
    <h1>Datei hochladen</h1>
</header>

<body>
    <?php

    $password = $_POST['password'];
    $file_hidden = $_POST['hidden'];
    $date_now = date('_d-m-Y H-i-s');

    if ($password != file_get_contents('uploadpassword.txt')) {
        echo 'Falsches Passwort!';
        return;
    }

    $uploaddir = $file_hidden ? 'files/hidden/' : 'files/';
    $uploadfile = basename($_FILES['userfile']['name']);

    $uploadfile_seperated = explode('.', $uploadfile);
    $uploadfile_extension = $uploadfile_seperated[array_key_last($uploadfile_seperated)];
    $uploadfile_name = str_replace($uploadfile_extension, '', $uploadfile);

    // Treat duplicate files properly
    if (file_exists($uploaddir . $uploadfile)) {
        $uploadfile = "$uploadfile_name $date_now.$uploadfile_extension";
    }

    // Uploading metadata
    if ($uploadfile_extension == 'meta') {
        $uploaddir = 'files/metadata/';
    }

    echo '<pre id=uploadedfile>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $uploadfile)) {
        echo "Fertig hochgeladen.\n";
        header('Location: index.php');
    } else {
        echo 'Upload fehlgeschlagen';
    }

    echo 'Debugging Informationen:';
    print_r($_FILES);

    print '</pre>';

    ?>
</body>

</html>