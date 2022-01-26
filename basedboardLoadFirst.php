<?php
print "<div id='posts-box'>";

$posts_offset = 0;
$posts_amount = 50;

$posts = array_diff(scandir("posts/"), array('..', '.'));
natsort($posts);
$posts = array_reverse($posts);
$posts = array_slice($posts, $posts_offset, $posts_amount);

foreach ($posts as $file) {
    $i = str_replace(".txt", "", substr($file, strpos($file, "_") + 1));
    $file_string = file_get_contents("posts/" . basename($file));
    echo "<div class='post'>" . $file_string . "<p style='text-align: right;'>#" . $i . "</p></div>";
}
print "</div>";
?>