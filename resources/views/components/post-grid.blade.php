@props(['posts'])
@props(['firstpost'])

<x-post-card-feature :post="$posts[0]"/>
@if($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach ($posts->skip(1) as $post)
            <x-post-card
                :post="$post"
                class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"
            />
        @endforeach
    </div>
@else
    <p class="text-center">
        Sorry, there is no posts yet.
    </p>
@endif
@if($posts->hasPages())
    <div class="flex-1 flex flex-col justify-between">
        <links class="mt-8 lg:mt-0">
            {{ $posts->links() }}
        </links>
    </div>
@endif
