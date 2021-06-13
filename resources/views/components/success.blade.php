{{-- Check success message
	An if statement that checks if session() has a 'success' key. The success key
	is only created by the ->flash() method on successful registration.
	We will then ->get() the success message and print it out.
	
	The get() helper function returns the value of the key. It is invoked via a
	shortcut from the session function itself.
 --}}

@if(session()->has('success'))
  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show"
    class="bottom-3 text-sm fixed right-3 bg-blue-500 text-white py-2 px-4 rounded-xl">
    <p>{{ session()->get('success') }}</p>
    {{-- Can be shorthanded to:
			<p>{{ session('success') }}</p>
    --}}
  </div>
@endif
