<!DOCTYPE html>
<html>

<head>
    <title>based</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="master.css" rel="stylesheet">
    <link href="basedboard.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        include "navigation.html";
        ?>
    </header>

    <h1 id="title">based board</h1>

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
        $posts = array_diff(scandir("posts/"), array('..', '.'));
        natsort($posts);
        $posts = array_reverse($posts);
        
        if (array_key_exists('button-post', $_POST)) {
            post($posts);
        }

        function post($posts_list)
        {
            $username = $_POST['username'];
            $text = $_POST['textbox'];

            $file = $posts_list[0];
            $file_count = str_replace(".txt", "", substr($file, strpos($file, "_") + 1))+1;
            $content = "<b>" . $username . "</b> " . date("[d.m.Y H:i:s]") . "<br>" . $text;

            // Check content for illegal html
            $illegal = [
                "<style",
                "<script",
                "<?",
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
            $i = str_replace(".txt", "", substr($file, strpos($file, "_") + 1));
            $file_string = file_get_contents("posts/" . basename($file));
            echo "<div class='post'>" . $file_string . "<p style='text-align: right;'>#" . $i . "</p></div>";
        }
        ?>
    </div>

</body>

</html>