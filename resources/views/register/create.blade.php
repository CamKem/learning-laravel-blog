<x-layout>
    <x-slot name="title">
        User Registration
    </x-slot>
    <x-panel class="max-w-lg mx-auto bg-gray-100 mt-12">
        <h1 class="text-center font-bold text-xl">User Register!</h1>
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
    </x-panel>
</x-layout>
