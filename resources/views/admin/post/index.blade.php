<x-layout>
    <x-slot name="title">
        Admin - Manage Posts
    </x-slot>
    <x-setting heading="Manage Posts">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-15 w-20">
                                                <img class="h-15 w-20 rounded"
                                                     src="{{asset('storage/' . $post->thumbnail)}}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <a href="{{ route('post.view', $post->slug) }}"
                                                   class="text-sm font-medium text-gray-900 hover:text-blue-500">
                                                    {{$post->title}}
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($post->published == true)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> Active </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"> Inactive </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/admin/posts/{{$post->id}}/edit"
                                           class="text-blue-400 hover:text-blue-600">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap align-bottom text-right text-sm font-medium">
                                        <form method="post" action="/admin/posts/{{$post->id}}">
                                            @csrf
                                            @method('delete')
                                            <button class="text-gray-400 hover:text-gray-900">Delete</button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($posts->hasPages())
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </x-setting>
</x-layout>
