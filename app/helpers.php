<?php

function get_path()
{
	var_dump($_SERVER);
	if (isset($_SERVER['REQUEST_URL'])) {
		return ltrim($_SERVER['REQUEST_URL'], "\\");
	} else if (isset($_SERVER['REQUEST_URI'])) {
		return ltrim($_SERVER['REQUEST_URI'], "\\");
	}
}

function markdown_file($file)
{
	return pathinfo($file, PATHINFO_EXTENSION) == 'md';
}

function get_files()
{
	$files = scandir('../storage/posts');
	return array_filter($files, "markdown_file");
}

function post_requested()
{
	$path = get_path();
	$files = get_files();

	return in_array("$path.md", $files);
}

function to_title($name)
{
	$words = explode('-', $name);
	for ($i = 0; $i < count($words); $i++) { 
		$words[$i] = ucfirst($words[$i]);
	}
	return implode(' ', $words);
}

function get_post($file_name)
{
	$path 			= "../storage/posts/$file_name.md";
	$contents 	= file_get_contents($path);
	$modified 	= filemtime($path);
	$parsedown 	= new Parsedown();

	$post = [
		'title' => to_title($file_name),
		'modified' => date("Y.m.d", $modified),
		'body' => $parsedown->text($contents)
	];

	return $post;
}

function get_posts()
{
	$files = scandir('../storage/posts');
	$files = array_filter($files, "markdown_file");
	$files = array_reverse($files);
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

	return $posts;
}

function posts()
{
	require '../app/posts.php';
}