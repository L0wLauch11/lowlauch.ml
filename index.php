<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>gaming seite</title>
    <link href="style.css" rel="stylesheet">
</head>

<header>
    <a href="https://github.com/L0wLauch11/lowlauch.ml">source</a>
    <a href="index.php">file mirror</a> 
</header>

<body>
    <h1>coole downloads</h1>

    <form enctype="multipart/form-data" action="uploadfile.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="107400000000"> <!-- Max filesize: 100GB -->
        Eigene Dateien hochladen: <input name="userfile" type="file">
        <input type="password" name="password">
        <input type="submit" value="Hochladen">
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

        $free_space = disk_free_space("/")/1000000000;
        $dir_size = GetDirectorySize("files")/1000000000; // size in gb
        echo "Speicher: " . round($dir_size) . "GB / " . round($free_space) . "GB";
        
        // Loop through directory and list all files
        $dir = new DirectoryIterator("files");
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();
                echo
                "<ul id='download-list'>"
                    . "<li>"
                    . $filename
                    . "<br><a href='files/" . $filename . "' download>Download</a> </li>
                        </ul>
                        ";
            }
        }
        ?>
    </div>
</body>

</html>