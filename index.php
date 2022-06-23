<!DOCTYPE html>
<html>

<head>
    <title>gaming seite</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">

    <style>
        #hallo {
            font-size: 48px;
            font-family: 'Comic Sans MS';
            text-align: center;
            text-shadow: -1px -1px 1px black, 1px -1px 1px black, -1px 1px 1px black, 1px 1px 1px black;
        }

        #trans-flag {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            border-radius: 16px;
            border-width: 2px;
            border-color: #000000;
            border-style: solid;
        }
    </style>
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <?php

    // This is here for shorter file links, done simply by redirecting
    if (!(empty($_GET['download']) && empty($_GET['d']))) {
        $file = empty($_GET['download']) ? $_GET['d'] : $_GET['download']; // d short for download
        $file_is_hidden = empty($_GET['hidden']) ? $_GET['h'] : $_GET['hidden']; // h short for hidden
        
        $hidden = (!empty($file_is_hidden) && $file_is_hidden == 1);
        
        if ($hidden) {
            $file_link = "filemirror/files/hidden/$file";
        } else {
            $file_link = "filemirror/files/$file";
        }
    
        header("Location: $file_link");
        die();
    }
    
    ?>

    <!---<h1>gaming seite</h1>-->
    <h2 id="hallo" class="marquee"><span style='color:#00FFF7;'>t</span><span style='color:#13EEF7;'>r</span><span style='color:#27DDF7;'>a</span><span style='color:#3ACCF7;'>n</span><span style='color:#4EBBF7;'>s</span> <span style='color:#7599F7;'>r</span><span style='color:#8989F7;'>i</span><span style='color:#9C78F7;'>g</span><span style='color:#B067F7;'>h</span><span style='color:#C456F7;'>t</span><span style='color:#D745F7;'>s</span><span style='color:#EB34F7;'>!</span></h2>
    <a href="https://play.google.com/store/apps/details?id=com.VKGames.LGBTFlags" target="_blank"><img id="trans-flag" src="img/flag-trans.png" alt="transgender flag" srcset=""></a>
</body> 

</html>