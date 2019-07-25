<?php
require '../core/functions.php';
require '../config/keys.php';
include '../core/db_connect.php';
require '../core/session.php';
checkSession();

$meta=[];
$meta['title']="Chad's Blog";

$stmt = $pdo->query('SELECT * FROM posts');

$content='<h1>Blog Posts</h1>';
$content .= "<ul>";
while($row=$stmt->fetch()){
    $content .= "<li><a href=\"view.php?slug={$row['slug']}\">" . "{$row['title']}</a></li>";
}
$content .= "</ul>";

$content .="<br><br>";
$content .="<a href=\"add.php\">Add a Post</a>";

include '../core/layout.php';


//$content .= "<div><a href=\"posts/view.php?slug={$row['slug']}\">{$row['title']}</a></div>";
