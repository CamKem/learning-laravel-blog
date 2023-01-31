<x-layout>
    <x-slot name="title">
        Admin - Publish New Post
    </x-slot>
    <x-setting heading="Publish New Post">
        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="thumbnail" type="file"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" class=" border border-gray-200 rounded-xl">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}" {{$category->id==old('category_id')?'selected':''}}>{{ucwords($category->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
