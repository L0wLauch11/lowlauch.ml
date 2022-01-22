<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>based</title>
        <link href="basedboard.css" rel="stylesheet">
    </head>

    <header>
        <h1>based board</h1>
        <h6>Regeln: kein cp</h6>
    </header>

    <body>
        <form method="post">
            <input type="text" name="username" value="username"><br>

            <textarea id="text-box" name="text-box"><pre>
    <!-- Dein Text hier -->
</pre></textarea><br>
        
            <button name="button-post">Posten</button>
        </form>

        <hr><br>

        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>

        <?php
            if(array_key_exists('button-post', $_POST))
            {
                post();
            }

            function post()
            {
                $username = $_POST['username'];
                $text = $_POST['text-box'];

                $fi = new FilesystemIterator("posts/", FilesystemIterator::SKIP_DOTS);
                $file_count = iterator_count($fi);
                file_put_contents("posts/p_" . $file_count . ".txt", "<b>" . $username . "</b>" . "\n" . $text);
            }

            // List posts
            $posts = array_diff(scandir("posts/"), array('..', '.'));
            natsort($posts); $posts = array_reverse($posts);
            foreach ($posts as $file)
            {
                $file_string = file_get_contents("posts/" . basename($file));
                echo "<div class='post'>" . $file_string . "</div>";
            }
        ?> 


    </body>
</html>