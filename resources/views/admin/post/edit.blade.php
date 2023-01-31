<x-layout>
    <x-slot name="title">
        Admin - Edit Post
    </x-slot>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <x-form.input name="title" :value="old('title', $post->title)"/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
                </div>

                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6"height="100" width="200">
            </div>

            <x-form.textarea name="excerpt" >{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" class=" border border-gray-200 rounded-xl">
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ucwords($category->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>

            <label for="published" class="flex items-center cursor-pointer relative mb-4">
                <input
                    type="checkbox"
                    id="published"
                    class="sr-only"
                    name="published"
                    {{ old('published', $post->published) == true ? 'checked' : '' }}
                >
                <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
                <span class="ml-3 text-gray-900 text-sm font-medium">Activate</span>
            </label>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
