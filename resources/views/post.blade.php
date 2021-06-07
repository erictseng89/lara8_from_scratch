<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	{{-- This link will refer to the file in the /public folder. --}}
	<link rel="stylesheet" href="/app.css">

	<title>My Blog</title>
</head>
<body>
	<article>
		<a href="/post"><h1>My first post</h1></a>
		<?= $post ?>
	</article>

	<a href="/">Go back</a>
</body>
</html>