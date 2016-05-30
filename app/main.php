<?php

if (post_requested()) {
	$post = get_post($path);
	require '../storage/post.php';
} else {
	require '../storage/index.php';
}