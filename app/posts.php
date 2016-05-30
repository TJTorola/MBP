<?php

$posts = get_posts();

echo "<ul>\n";
foreach ($posts as $post) {
	echo "		<li>\n";
	echo "			<a href='/$post[name]'>\n";
	echo "				$post[title]\n";
	echo "				<small>[$post[modified]]</small>\n";
	echo "			</a>\n";
	echo "		</li>\n";
}
echo "	</ul>\n";