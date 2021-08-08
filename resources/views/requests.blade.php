<?php
?>
<x-main>
    <x-navbar :notifications="$notifications" />
    <div class="grid grid-cols-5 gap-4 pt-36">
        <div class="col-span-1 flex flex-col items-center">
            <x-user-widget :user="Auth::user()"/>
        </div>
        <div class="col-span-3 flex flex-col justify-center items-center">
            <x-notifications :notifications="$requests"/>
        </div>
</x-main>
