<x-layout>
    <x-slot name="title">
        User Login
    </x-slot>
    <main class="max-w-lg mx-auto bg-gray-100 border border-gray-300 p-6 rounded-xl">
        <x-panel>
            <h1 class="text-center font-bold text-xl">User Login</h1>

            <form method="POST" action="/login" class="mt-10">
                @csrf
                <x-form.input name="email" type='email' autocomplete="username"/>
                <x-form.input name="password" type="password" autocomplete="old-password"/>
                <x-form.button>Submit</x-form.button>
            </form>
        </x-panel>

    </main>
</x-layout>
