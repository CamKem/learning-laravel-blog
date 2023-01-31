<x-layout>
    <x-slot name="title">
        Blog Post - {{ $post->title }}
    </x-slot>

    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

                <p class="mt-4 block text-gray-400 text-xs">
                    Published
                    <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3 text-left">
                        <a href="/?author={{ $post->author->username }}">
                            <h5 class="font-bold">
                                {{ $post->author->firstname }}
                                {{ $post->author->lastname }}
                            </h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-end mb-6">
                    @php $previous = url()->previous(); @endphp
                    @if(str_contains($previous, 'category'))
                        <a href="{{ url()->previous() }}"
                           class="transition-colors duration-300 mr-20 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Category
                        </a>
                    @elseif(str_contains($previous, 'author'))
                        <a href="{{ url()->previous() }}"
                           class="transition-colors duration-300 mr-20 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Author
                        </a>
                    @else
                        <a href="{{ route('home') }}"
                           class="transition-colors duration-300 mr-20 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Posts
                        </a>
                    @endif

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
                    @elseauth
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 hover:text-pink-300 text-white border border-blue-500"
                        >
                            <i class="fas fa-heart"></i> Like ( {{ $post->like->count() }} )
                        </a>
                    @endauth
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{$post->title}}
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    {!!$post->body!!}
                </div>
            </div>

            <section class="col-span-8 col-start-5 mt-10 space-y-6">
                @include("posts._add-comment-form")

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 6000)"
                         x-show="show"
                         role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @foreach($comments as $comment)
                    <x-post-comment :comment="$comment"/>
                @endforeach
                @if($comments->hasPages())
                    <comment-links class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                        <div class="col-span-12 text-center">
                            {{ $comments->links() }}
                        </div>
                    </comment-links>
                @endif
            </section>
        </article>
    </main>
</x-layout>


