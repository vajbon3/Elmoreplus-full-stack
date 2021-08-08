<?php
?>
<x-main title="Login">
    <x-form class="w-1/6" method="POST" :action="route('login')">
        @if(Session::has("error"))
            <x-flash-error :error="Session::get('error')" />
        @endif

        @bind(Auth::user())
        <h1>Login</h1>
        <x-form-input name="email" placeholder="email" />
        <x-form-input name="password" type="password" placeholder="password"/>
        <a class="text-gray-400 m-2" href="#">Forgot the password?</a>
        <x-form-checkbox name="remember" label="Remember me"/>
        <x-form-submit>Login</x-form-submit>
        @endbind
    </x-form>
</x-main>

<script src="{{mix("js/login.js")}}"></script>
<link rel="stylesheet" href="{{mix("css/login.css")}}">
