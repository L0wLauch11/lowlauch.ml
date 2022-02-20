<!DOCTYPE html>
<html>

<head>
    <title>based</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/style/variables.css" rel="stylesheet">
    <link href="/style/master.css" rel="stylesheet">
    <link href="basedboard.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php
        $root = $_SERVER["DOCUMENT_ROOT"];
        include "$root/navigation.html";
        ?>
    </header>

    <div id="container">
        <script>
            let postsAmount = 50;
            let postsOffset = 0;
            let hasResponded = true;
            let lastScrollLocation = -1; // cringe

            // Load new content
            window.onscroll = function(ev) {
                let pageY = (window.innerHeight + window.pageYOffset);
                if (hasResponded && pageY != lastScrollLocation && pageY >= document.body.offsetHeight) {
                    postsOffset += postsAmount;
                    lastScrollLocation = window.innerHeight + window.pageYOffset;
                    hasResponded = false;

                    let sendString = "postsAmount=" + postsAmount + "&postsOffset=" + postsOffset;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("posts-box").innerHTML += this.responseText;
                            hasResponded = true;
                        }
                    };
                    xmlhttp.open("GET", "basedboardLoadPosts.php?" + sendString, true);
                    xmlhttp.send();
                }
            };


            // Stop user from posting twice
            if (window.history.replaceState) {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;

                window.history.replaceState(null, null, window.location.href);
            }
        </script>

        <h1 id="title">based board</h1>
        <p>Regeln: keine +18 Inhalte</p>
        <p><b>Nachricht posten: </b></p>

        <form method="post">
            <input class="textbox" type="text" name="username" value="username"><br>

            <textarea class="textbox" id="textbox" name="textbox"><pre>
text
</pre></textarea><br>

            <button class="button" name="button-post">Posten</button>
        </form>

        <hr><br>

        <?php
        $posts = array_diff(scandir('posts/'), array('..', '.'));
        natsort($posts);
        $posts = array_reverse($posts);

        if (array_key_exists('button-post', $_POST)) {
            post($posts);
        }

        function post($posts_list)
        {
            $username = $_POST['username'];

            if ($username == 'username') {
                print 'Du musst deinen Benutzernamen ändern';
                return;
            }

            $text = $_POST['textbox'];
            $date_now = date('[d.m.Y H:i:s]');

            $file = $posts_list[0];
            $file_count = str_replace('.txt', '', substr($file, strpos($file, '_') + 1)) + 1;
            $content = "<b>$username</b> $date_now<br>$text";

            // Check content for illegal html
            $illegal = [
                '<style',
                '<script',
                '<?',
            ];

            foreach ($illegal as $illegal_statement) {
                if (str_contains($content, $illegal_statement))
                    return;
            }

            // Write to file
            file_put_contents("posts/p_$file_count.txt", $content);
        }

        // List posts
        include 'basedboardLoadPosts.php';

        ?>    
    </div>

</body>

</html>