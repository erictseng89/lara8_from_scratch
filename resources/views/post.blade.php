<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	{{-- This link will refer to the file in the /public folder. --}}
	<link rel="stylesheet" href="/app.css">

	<title>{{ $post->title }}</title>
</head>
<body>
	<h1>{{ $post->title }}</h1>
	{!! $post->body !!}	
	<a href="/">Go back</a>
</body>
</html>