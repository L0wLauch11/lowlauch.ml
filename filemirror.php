<!DOCTYPE html>
<html>

<head>
    <title>dateien</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="variables.css" rel="stylesheet">
    <link href="master.css" rel="stylesheet">
    <link href="downloadmirror.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        include "navigation.html";
        ?>
    </header>

    <div id="container">
        <h1>coole downloads</h1>

        <form enctype="multipart/form-data" action="uploadfile.php" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="107400000000"> <!-- Max filesize: 100GB -->
            Eigene Dateien hochladen: <input class="button" name="userfile" type="file"> <br><br>
            Passwort: <input class="textbox" type="password" name="password">
            <input class="button" type="submit" value="Hochladen">
            versteckte Datei? <input class="checkbox" type="checkbox" name="hidden"><br><br><br>
            <hr><br>
        </form>

        <div id="download-box">
            <?php
            function GetDirectorySize($path)
            {
                $bytestotal = 0;
                $path = realpath($path);
                if ($path !== false && $path != '' && file_exists($path)) {
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
                        $bytestotal += $object->getSize();
                    }
                }
                return $bytestotal;
            }

            $free_space = round(disk_total_space('/') / 1000000000);
            $dir_size = round((disk_total_space('/')-disk_free_space('/')) / 1000000000); // size in gb
            echo "Speicher: {$dir_size}GB / {$free_space}GB";

            print '<ul id="download-list">';
            // Loop through directory and list all files
            $dir = new DirectoryIterator('files');
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                    $filename = $fileinfo->getFilename();
                    $file_mod_time = date('[d.m.Y H:i:s]', filemtime('files/' . $filename));

                    // Don't show hidden folder
                    if ($filename != 'hidden' && $filename != 'metadata') {
                        echo "<li>$filename <div class='date'>$file_mod_time</div><br>";
                        
                        // Check for metadata from file
                        if (file_exists('files/metadata/' . $filename . '.meta')) {
                            echo '<i>' . file_get_contents("files/metadata/$filename.meta") . '</i><br>';
                        }

                        echo "<a href='files/$filename' download>Download</a></li>";
                    }
                }
            }
            print '</ul>'
            ?>
        </div>
    </div>
</body>

</html>