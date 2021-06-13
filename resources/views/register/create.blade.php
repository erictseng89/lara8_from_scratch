<x-layout>
  <section class="px-6 py-8">
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-xl border-gray-200">
      <h1 class="text-center font-bold text-xl">Register</h1>

      {{-- @csrf
				Stands for Cross site request forgery
				This is an attack to trick a website into executing an unwanted action in which a user is logged in to.
				This directive produces a token. The laravel server will validate the token.
			 --}}

      <form action="/register" method="post" class="mt-10">
        @csrf

        <div class="mb-6">
          <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray 700">
            Name
          </label>
          {{-- old()
						This function will simply return the value of the variable that is
						its first parameter. This can be used to reset form information
						after a failed POST request. --}}
          <input type="text" name="name" id="name" value="{{ old('name') }}"
            class="border border-gray-400 p-2 w-full" required>
          {{-- @error
						This is a directive that passes if the input value does not pass the
						validate method. This director automatically will produce a validate error
						message that is very clear.
						--}}
          @error('name')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray 700">
            Email
          </label>
          <input type="email" name="email" id="email" value="{{ old('email') }}"
            class="border border-gray-400 p-2 w-full" required>
          @error('email')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="username" class="block mb-2 uppercase font-bold text-xs text-gray 700">
            Username
          </label>
          <input type="text" name="username" id="username" value="{{ old('username') }}"
            class="border border-gray-400 p-2 w-full" required>
          @error('username')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray 700">
            Password
          </label>
          <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full" required>
          @error('password')
            <p class="text-red-500 text-xs mt-1">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-6">
          <button type="submit" class="bg-blue-400 text-white rounded p-2 hover:bg-blue-500">
            Submit
          </button>
        </div>


      </form>
    </main>
  </section>
</x-layout>
