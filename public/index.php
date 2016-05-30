<?php

require '../vendor/parsedown.php';

function markdown_file($file)
{
	return pathinfo($file, PATHINFO_EXTENSION) == 'md';
}

function to_title($name)
{
	$words = explode('-', $name);
	for ($i = 0; $i < count($words); $i++) { 
		$words[$i] = ucfirst($words[$i]);
	}
	return implode(' ', $words);
}

$path 	= $_GET['path'];
$files 	= scandir('../storage/posts');
$files 	= array_filter($files, "markdown_file");
$posts 	= [];

if (in_array("$path.md", $files)) {
	$file 			= "../storage/posts/$path.md";
	$contents 	= file_get_contents($file);
	$modified 	= filemtime($file);
	$parsedown 	= new Parsedown();

	$post = [
		'title' => to_title($path),
		'modified' => date("Y.m.d", $modified),
		'body' => $parsedown->text($contents)
	];

	require '../storage/post.php';
} else {
	$posts = [];

	foreach ($files as $file) {
		$name 			= explode('.', $file)[0];
		$file 			= "../storage/posts/$file";
		$modified 	= filemtime($file);

		$posts[] = [
			'title' => to_title($name),
			'name' => $name,
			'modified' => date("Y.m.d", $modified)
		];
	}

	require '../storage/index.php';
}