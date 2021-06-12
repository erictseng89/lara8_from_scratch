<x-layout>
  @include("post._header")
  <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    @if($posts->count())
      <x-post-grid :posts="$posts" />

      {{-- Laravel will automatically create links and buttons --}}
      {{ $posts->links() }}
    @else
      <p>No Post yet. Check back later!</p>
    @endif
  </main>
</x-layout>
