<?php
?>
<x-main title="home">
    <x-navbar :notifications="$notifications"/>
    <div class="grid grid-cols-5 gap-4 pt-36">
        <div class="col-span-1 flex flex-col items-center">
            <x-user-widget :user="Auth::user()"/>
        </div>
        <div class="col-span-3 flex flex-col justify-center items-center">
            <x-form id="createPost" method="POST" action="/api/posts" class="create-post w-2/3 m-2 h-auto">
                <h3>Create a post</h3>
                <x-form-textarea name="body" placeholder="tell us about your day" rows="3" cols="70"/>
                <div class="flex justify-around ">
                    <x-form-submit>
                        Post
                    </x-form-submit>
                </div>
            </x-form>
            <div id="posts" class="w-full flex flex-col items-center ">
                <x-posts :posts="$posts" />
            </div>
        </div>
    </div>
</x-main>
