@props(['comment'])
<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc?u={{$comment->author->id}}" alt="" width="60" height="60"
                 class="rounded-xl">
        </div>

        <div class="w-full">
            <header class="mb-4">
                <h3 class="font-bold">{{$comment->author->username}}</h3>

                <p class="text-xs">
                    Posted
                    <time>{{$comment->created_at->format('F j, Y, g:i a')}}</time>
                </p>
            </header>

            <p>
                {{$comment->body}}
            </p>

            @php
                //get the comment id
                $comment_id = $comment->id;
            //check to see if comment like table has a row that matches the comment id and the user id
            if (\App\Models\Comment::find($comment_id)->likes()->where('user_id', auth()->id())->exists()) {
                //if it does, then the user has liked the comment
                $comment->like_exists = true;
            } else {
                //if it doesn't, then the user has not liked the comment
                $comment->like_exists = false;
            }
            @endphp

            @if ($comment->user_id === auth()->id())
                <div class="space-x-2 flex align-middle justify-end">
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form.button>
                            Delete
                        </x-form.button>
                    </form>
                </div>
            @endif
            @auth
                @if($comment->like_exists)
                    <form action="{{ route('comment.like.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button
                            class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 text-pink-300 hover:text-white hover:bg-blue-500 border border-blue-500"
                            type="submit"
                        >
                            <i class="fas fa-heart"></i> Liked ( {{ $comment->likes->count() }} )
                        </button>
                    </form>
                @else
                    <form action="{{ route('comment.like.store', $comment->id) }}" method="post">
                        @csrf
                        <button
                            class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 hover:text-pink-300 text-white border border-blue-500"
                            type="submit"
                        >
                            <i class="fas fa-heart"></i> Like ( {{ $comment->likes->count() }} )
                        </button>
                    </form>
                @endif
            @elseauth
                <a href="{{ route('login') }}"
                   class="px-3 py-2 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150 text-xs uppercase font-extrabold bg-blue-500 hover:text-pink-300 text-white border border-blue-500"
                >
                    <i class="fas fa-heart"></i> Like ( {{ $comment->likes->count() }} )
                </a>
            @endauth
        </div>
    </article>
</x-panel>
