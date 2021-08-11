<?php
?>
<x-main title="search">
    <x-navbar :notifications="$notifications"/>
    <div class="grid grid-cols-5 gap-4 pt-36">
        <div class="col-span-1"></div>
        <div class="col-span-3">
            <div class="result">
                @foreach($users as $user)
                    <x-user-result :user="$user"/>
                @endforeach
                    <script src="{{ mix("js/sendrequest.js") }}"></script>
            </div>
        </div>
        <div class="col-span-1"></div>
    </div>
</x-main>
