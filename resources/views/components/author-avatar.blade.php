@props(['author'])

<a href="?author={{ $author->username }}">
  <div class="flex items-center text-sm">
    <img src="/images/lary-avatar.svg" alt="Lary avatar">
    <div class="ml-3">
      <h5 class="font-bold">{{ $author->name }}</h5>
    </div>
  </div>
</a>
