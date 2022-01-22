<html>
    <header>
        <h1>Datei hochladen</h1>
    </header>
    
    <body>
        <?php

        $password = $_POST['password'];

        if($password == file_get_contents("uploadpassword.txt"))
        {
            $uploaddir = 'files/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            echo '<pre id=uploadedfile>';
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Upload failed";
            }

            echo 'Debugging Informationen:';
            print_r($_FILES);

            print "</pre>";
        } else
        {
            echo "Falsches Passwort";
        }
        ?>
    </body>
</html>