<x-layout>
  <article>
    <h1>{{ $post->title }}</h1>
    <h3>By <a href="/authors/{{ $post->author->name }}">{{ $post->author->name }}</a></h3>
    {!! $post->body !!}
  </article>
  <a href="/">Go back</a>
</x-layout>
