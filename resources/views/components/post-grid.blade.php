@props(['posts'])

@if ($posts->currentPage() === 1)
    <x-post-card-feature :post="$posts[0]"/>
@elseif(!$posts->hasPages())
    <x-post-card-feature :post="$posts[0]"/>
@endif

@if($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach ($posts->skip(1) as $post)
            <x-post-card
                :post="$post"
                class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"
            />
        @endforeach
    </div>
@endif

@if($posts->hasPages())
    <div class="flex-1 flex flex-col justify-between">
        <links class="mt-8 lg:mt-0">
            {{ $posts->links() }}
        </links>
    </div>
@endif
