@props(['post'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5">
        <div>
            {{-- TODO: Add image --}}
            <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2 flex">
                    <x-category-link :category="$post->category"/>

                    @auth
                        @if($post->like_exists)
                            <form action="{{ route('post.like.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 text-pink-300 hover:text-white hover:bg-blue-500 border border-blue-500"
                                    type="submit"
                                >
                                    <i class="fas fa-heart"></i> Liked ( {{ $post->like->count() }} )
                                </button>
                            </form>
                        @else
                            <form action="{{ route('post.like.store', $post) }}" method="post">
                                @csrf
                                <button
                                    class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 hover:text-pink-300 text-white border border-blue-500"
                                    type="submit"
                                >
                                    <i class="fas fa-heart"></i> Like ( {{ $post->like->count() }} )
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        <a href="{{ route('post.view', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                {!! $post->excerpt !!}
                {{-- @php Str::words($post->body, 500,'...'); @endphp --}}
            </div>

            <div class="text-sm mt-4 font-bold">
                <p>
                    {{ $post->comments->count() }} Comments
                </p>
            </div>

            <div class="text-sm mt-4 font-bold">
                <h5 class="font-bold">
                    Viewed {{ $post->views }} times
                </h5>
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="?author={{ $post->author->username }}">
                                {{ $post->author->firstname }}
                                {{ $post->author->lastname }}
                            </a>
                        </h5>
                    </div>
                </div>

                <div>
                    <a href="{{ route('post.view', $post->slug) }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>
