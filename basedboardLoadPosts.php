<?php
$posts_offset = $_GET['postsOffset'];
$posts_amount = $_GET['postsAmount'];

$posts = array_diff(scandir("posts/"), array('..', '.'));
natsort($posts);
$posts = array_reverse($posts);
$posts = array_slice($posts, $posts_offset, $posts_amount);

foreach ($posts as $file) {
    $i = str_replace(".txt", "", substr($file, strpos($file, "_") + 1));
    $file_string = file_get_contents("posts/" . basename($file));
    echo "<div class='post'>" . $file_string . "<p style='text-align: right;'>#" . $i . "</p></div>";
}
?>