@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>
    <div class="flex">
        <aside class="w-36 flex-shrink-0">
            <h3 class="font-semibold mb-3 pb-0.5 border-b-2 mr-2">Links</h3>

            <ul>
                <li>
                    <a href="{{ route('admin.post.dashboard') }}" class="{{ request()->routeIs('admin.post.dashboard') ? 'text-blue-500' : 'hover:text-blue-500' }}">All Posts</a>
                </li>

                <li class="mt-2">
                    <a href="{{ route('admin.post.create') }}" class="{{ request()->routeIs('admin.post.create') ? 'text-blue-500' : 'hover:text-blue-500' }}">New Post</a>
                </li>

                <li class="mt-2">
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.category.index') ? 'text-blue-500' : 'hover:text-blue-500' }}">All Categories</a>
                </li>

                <li class="mt-2">
                    <a href="{{ route('admin.categories.create') }}" class="{{ request()->routeIs('admin.category.create') ? 'text-blue-500' : 'hover:text-blue-500' }}">New Category</a>
                </li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
