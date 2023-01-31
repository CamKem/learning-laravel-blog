@auth
    <x-panel>
        <form method="POST" action="{{ route('comment.create', $post->slug) }}">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc?u={{ auth()->id() }}" alt="" width="40" height="40"
                     class="rounded-xl">
                <h2 class="ml-4">Want to participate {{ auth()->user()->username }}?</h2>
            </header>

            <div class="mt-4">
                <textarea
                    name="body"
                    class="w-full p-3 text-sm focus:outline-none focus:ring"
                    rows="5"
                    placeholder="Quick, think of something to say!"></textarea>
                @error("body")
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-form.button>
                    Post
                </x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <x-panel>
        <p class="font-semibold">
            <a href="{{ route('register') }}" class="hover:underline">Register</a> or
            <a href="{{ route('login') }}" class="hover:underline">log in</a> to leave a comment.
        </p>
    </x-panel>
@endauth
