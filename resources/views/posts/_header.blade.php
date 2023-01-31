<header class="max-w-xl mx-auto mt-12 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Aurfied Gold</span> News
    </h1>
    <p class="text-sm mt-6">
        Keep up to date with the latest news and updates from the Aurfied Gold team.
        While we bring you exciting news from the world of Aurfied Gold, we also bring you the latest news from the
        world of mining and prospecting.
    </p>

    <div class="space-y-2 lg:inline-flex lg:space-y-0 lg:space-x-4 mt-6">
        <!--  Category -->
        <div class="relative items-center h-10 lg:inline-flex bg-gray-100 rounded-xl">
            <x-category-drop-down />
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex h-10 bg-gray-100 rounded-xl">
            <form method="GET" action="/">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" placeholder="Find something"
                       class="bg-transparent sm:w-96 placeholder-black border-0 font-semibold text-sm"
                       value="{{ request('search') }}"
                >
            </form>
        </div>
    </div>
</header>
