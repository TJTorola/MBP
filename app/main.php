<?php

if (post_requested()) {
	$post = get_post();
	require '../storage/post.php';
} else {
	require '../storage/index.php';
}