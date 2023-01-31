<x-layout>
    <x-slot name="title">
        Blog
    </x-slot>

    @include('posts._header')

    @if($posts->count() == 0)
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <h1>
                No Posts Found
            </h1>
        </main>
    @else
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
                <x-post-grid :posts="$posts" />
        </main>
    @endif
</x-layout>
