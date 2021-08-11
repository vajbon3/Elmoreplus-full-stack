<div style="width: 500px"
    id="notifications" {{ $attributes->merge(["class" => "flex flex-col justify-center bg-white p-4 rounded transparent-border ".$bclass]) }}">
    @foreach($notifications as $notification)
        <div id="{{ $notification->id }}" class="flex items-center">
            <div>
                <img src="#" alt="user image">
            </div>
            <a href="{{$notification->url}}">
                <div>
                    <p>{{ $notification->text }}</p>
                </div>
            </a>
            @if($notification->type == 1)
                <div class="flex buttons">
                    <x-form-submit class="m-1 friendship-accept inline-block">
                        Accept
                    </x-form-submit>
                    <x-form-submit class="m-1 friendship-reject inline-block">
                        Reject
                    </x-form-submit>
                </div>
            @endif
        </div>
    @endforeach

    <x-throttle />
</div>

<script src="{{ mix("js/friends.js") }}"></script>
<script src="{{ mix("js/notifications.js") }}"></script>

