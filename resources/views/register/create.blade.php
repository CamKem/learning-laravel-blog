<x-layout>
    <x-slot name="title">
        User Registration
    </x-slot>
    <section class="px-4 py-6 mt-2">
        <main class="max-w-lg mx-auto bg-gray-100 border border-gray-300 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">User Register!</h1>
            {{-- @if($errors->any())
                <ul>
                    <li class="text-red-500 text-xs">There is an error, please correct it!</li>
                </ul>
            @endif --}}
            <form method="POST" action="/register" class="mt-10">
                @csrf
                <x-form.input name="firstname" type="text" placeholder="First Name" value="{{old('firstname')}}"/>
                <x-form.input name="lastname" type="text" placeholder="Last Name" value="{{old('lastname')}}"/>
                <x-form.input name="username" type="text" placeholder="Username" value="{{old('username')}}"/>
                <x-form.input name="email" type="email" placeholder="Email" value="{{old('email')}}"/>
                <x-form.input name="password" type="password" placeholder="Password"/>
                <x-form.input name="password_confirmation" type="password" placeholder="Confirm Password"/>
                <x-form.button>Register</x-form.button>
            </form>
        </main>
    </section>
</x-layout>
