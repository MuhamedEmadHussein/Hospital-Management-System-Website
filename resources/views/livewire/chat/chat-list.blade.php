<div>
    <div>
        <div class="main-chat-list" id="ChatList">
            @foreach ($conversations as $conversation)
                <div class="media new">
                    {{-- <div class="main-img-user online">
                        <img alt="" src="{{ URL::asset('Dashboard/img/faces/5.jpg') }}"> <span>2</span>
                    </div> --}}
                    <div wire:click="chatUserSelected({{ $conversation }},{{ $this->getUsers($conversation, $name = 'id') }})"
                        class="media-body">
                        <div class="media-contact-name">
                            <span>{{ $this->getUsers($conversation, $name = 'name') }}</span>
                            <span>{{ $conversation->messages->last()->created_at->diffForHumans() }}</span>
                        </div>
                        <p>{{ $conversation->messages->last()->body }}</p>
                    </div>
                </div>
            @endforeach
        </div><!-- main-chat-list -->
    </div>
</div>
