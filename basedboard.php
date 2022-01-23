<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>based</title>
    <link href="style.css" rel="stylesheet">
    <link href="basedboard.css" rel="stylesheet">
</head>

<header>
    <a href="https://github.com/L0wLauch11/lowlauch.ml" target="_blank">source</a>
    <a href="index.php">file mirror</a>

    <h1>based board</h1>
    <h6>Regeln: kein cp</h6>
</header>

<body>
    <form method="post">
        <input class="textbox" type="text" name="username" value="username"><br>

        <textarea class="textbox" id="textbox" name="textbox"><pre>
<!-- Dein Text unter diesem Kommentar -->

</pre></textarea><br>

        <button class="button" name="button-post">Posten</button>
    </form>

    <hr><br>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <div id="posts-box">
        <?php
        if (array_key_exists('button-post', $_POST)) {
            post();
        }

        function post()
        {
            $username = $_POST['username'];
            $text = $_POST['textbox'];

            $fi = new FilesystemIterator("posts/", FilesystemIterator::SKIP_DOTS);
            $file_count = iterator_count($fi);
            $content = "<b>" . $username . "</b> " . date("d.m.Y H:i:s") . "<br>" . $text;

            // Check content for illegal html
            $illegal = [
                "<style",
                "<script"
            ];

            foreach ($illegal as $illegal_statement) {
                if (str_contains($content, $illegal_statement))
                    return;
            }

            // Write to file
            file_put_contents("posts/p_" . $file_count . ".txt", $content);
        }

        // List posts
        $posts = array_diff(scandir("posts/"), array('..', '.'));
        natsort($posts);
        $posts = array_reverse($posts);
        foreach ($posts as $file) {
            $file_string = file_get_contents("posts/" . basename($file));
            echo "<div class='post'>" . $file_string . "</div>";
        }
        ?>
    </div>

</body>

</html>