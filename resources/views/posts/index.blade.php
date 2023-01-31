<x-layout>
    <x-slot name="title">
        Blog
    </x-slot>

    @include('posts._header')

    @if($posts->count() == 0)
        <main class="max-w-6xl w-72 text-center mx-auto mt-6 lg:mt-16 space-y-6">
            <h1>
                Sorry, we have not found any posts.
            </h1>
        </main>
    @else
        <main class="max-w-6xl mx-auto mt-6 lg:mt-16 space-y-6">
                <x-post-grid :posts="$posts" />
        </main>
    @endif
</x-layout>
