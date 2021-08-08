<div class="fixed flex justify-around shadow w-full items-center bg-white">
    <div class="flex justify-center items-center">
        <a href="/"><img style="width: 120px"
                         src="http://pixelartmaker-data-78746291193.nyc3.digitaloceanspaces.com/image/65422dfa6be08fc.png"
                         alt=""></a>
        <h1 style="font-size: 35px; color: #2980B9;">Elmore+</h1>
    </div>
    <div class="p-4">
        <div class="bg-white flex items-center rounded-full">
            <form class="flex" method="GET" action="{{ route("search") }}">
                <input class="rounded-l-full py-4 px-6 text-gray-700 leading-tight focus:outline-none"
                       id="search" name="query"
                       type="text" placeholder="Search">

                <div
                     class="p-4">
                    <button
                        class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="navbar__buttons flex items-center justify-center">
        <i id="chat-button" style="font-size: 30px; color: #2980B9;" class="cursor-pointer fas fa-comments m-2"></i>
        <i id="notification-button" style="font-size: 30px; color: #2980B9;" class="cursor-pointer fas fa-bell m-2"></i>
        <x-notifications bclass="hidden absolute" :notifications="$notifications"/>
        <i id="settings-button" style="font-size: 30px; color: #2980B9;" class="cursor-pointer fas fa-sort-down"></i>
    </div>
</div>

<script src="{{mix("js/navbar.js")}}"></script>
