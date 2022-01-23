<html>
    <header>
        <h1>Datei hochladen</h1>
    </header>
    
    <body>
        <?php

        $password = $_POST['password'];

        if($password != file_get_contents("uploadpassword.txt")) {
            echo "Falsches Passwort!";
            return;
        }

        $uploaddir = 'files/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        echo '<pre id=uploadedfile>';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Fertig hochgeladen.\n";
            header('Location: index.php');
        } else {
            echo "Upload fehlgeschlagen";
        }

        echo 'Debugging Informationen:';
        print_r($_FILES);

        print "</pre>";
        
        ?>
    </body>
</html>