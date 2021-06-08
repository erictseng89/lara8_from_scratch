<x-layout>
  @foreach ($posts as $post)
    <article>
      <h1>
        <a href="/post/{{ $post->slug }}">{{ $post->title }}</a>
      </h1>
      <h3>
        <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
      </h3>
      {{ $post->excerpt }}
    </article>
  @endforeach
</x-layout>
