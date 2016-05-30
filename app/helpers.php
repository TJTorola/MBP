<?php

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