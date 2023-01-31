<x-layout>
    <x-slot name="title">
        Blog Post - {{ $post->title }}
    </x-slot>

    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="../images/illustration-1.png" alt="" class="rounded-xl">

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
                <div class="hidden lg:flex justify-between mb-6">
                    @php $previous = url()->previous(); @endphp
                    @if(str_contains($previous, 'category'))
                        <a href="{{ url()->previous() }}"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Category
                        </a>
                    @elseif(str_contains($previous, 'author'))
                        <a href="{{ url()->previous() }}"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Author
                        </a>
                    @else
                        <a href="{{ route('home') }}"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <x-icon name="back-arrow"/>
                            Back to Posts
                        </a>
                    @endif

                    <x-category-link :category="$post->category"/>
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

                @foreach($post->comments as $comment)
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


