<?php

$path 	= $_GET['path'];
$files 	= scandir('../storage/posts');
$files 	= array_filter($files, "markdown_file");

if (in_array("$path.md", $files)) {
	$post = get_post($path);
	require '../storage/post.php';
} else {
	require '../storage/index.php';
}