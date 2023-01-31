<x-layout>
    <x-slot name="title">
        User Login
    </x-slot>
    <x-panel class="max-w-lg mx-auto bg-gray-100 mt-12">
        <h1 class="text-center font-bold text-xl">User Login</h1>

        <form method="POST" action="/login" class="mt-10">
            @csrf
            <x-form.input name="email" type="email" autocomplete="username"/>
            <x-form.input name="password" type="password" autocomplete="old-password"/>
            <x-form.button>Submit</x-form.button>
        </form>
    </x-panel>
</x-layout>
