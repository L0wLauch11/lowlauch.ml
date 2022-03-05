<!DOCTYPE html>
<html>

<head>
    <title>gaming seite</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">
</head>

<style>
    #hallo {
        font-size: 48px;
        font-family: 'Comic Sans MS';
    }
</style>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <h1>gaming seite</h1>
    <marquee>
        <h2 id="hallo">hallo</h2>
    </marquee>
</body>

</html>