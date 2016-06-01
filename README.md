# MBP

Minimal Blogging Platform is a Blogging tool built off of PHP. It uses Git as it's user authentication where in the owner of the blog is to make a repository in the storage to add posts. The posts are written as markdown files within the posts folder. MBP then parses that folder to populate the posts and individual post page. It has no commenting capibilties, DB, editor, or admin panel to speak of. But it manages posts effeciantly for someone who knows git and markdown.

The required folder structure of an individual blog (using storage as it's root folder) is as follows.
/css/
/fonts/
/img/
/js/
/posts/
index.php
post.php

The css, fonts, img, and js folders are all symbolically linked to the public folder and therefore accessable within the DOM. The posts folder is what is to be populated with posts in markdown files (see below of an example of a post file. The index.php is what any route that doesn't resolve to a post will point to, in which a posts() function will be made availble that echos out an `<ul>` of posts followed by their modified dates. And finally post.php is what every route that does resolve to a post file in which a $post object will be made availible with a 'title', 'modified', and 'body' field. 

An example of a post file is /posts/this-is-a-post.md where MBP would parse out "This is a Post" as the title, the files modification date as its modified field (parsed into the format YYYY-MM-DD), and the contents of the file as it's body.

View blog.tjt.codes for an example.
