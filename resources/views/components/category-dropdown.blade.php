<x-dropdown-menu>

  <x-slot name="trigger">
    <button class="py-2 pl-3 pr-9d text-sm font-semibold w-full lg:w-32 text-left lg:inline-flex flex">
      {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Category' }}
      <x-icons name='down-arrow' class="absolute pointer-events-none" style="right:12px" />
    </button>
  </x-slot>

  <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="request()->routeIs('home')">
    All
  </x-dropdown-item>
<div>today
 <p>This doesnt even format properly</p>
</div>
	{{--
		Merge http queries together.
		If we already have a query string in the uri, we can merge it using
		http_build_query
		This global function allows you to change a key/value pair into a valid
		query string.

			['name' = 'john']			name=john
		--}}
  @foreach ($categories as $category)
    <x-dropdown-item href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
      :active='request()->is("/category/{{ $category->slug }}")'>
      {{ ucwords($category->name) }}
    </x-dropdown-item>
  @endforeach

</x-dropdown-menu>

	{{-- Alternatively: :active="request()->is('*' . $category->slug)" This checks the uri to make
	sure its the same --}}

	{{-- <a href="category/{{ $category->slug }}" class="block text-left px-3 text-sm leading-6
	hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white isset($currentCategory) &&
	$currentCategory->is($category) ? '' : '' }}"> {{ ucwords($category->name) }}</a> --}}