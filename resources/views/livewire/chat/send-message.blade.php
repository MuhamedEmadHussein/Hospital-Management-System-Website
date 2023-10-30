<div>
    <form wire:submit.prevent="sendMessage">
        <div class="main-chat-footer">
            {{-- <nav class="nav">
            <a class="nav-link" data-toggle="tooltip" href="" title="Add Photo"><i class="fas fa-camera"></i></a> <a
                class="nav-link" data-toggle="tooltip" href="" title="Attach a File"><i
                    class="fas fa-paperclip"></i></a> <a class="nav-link" data-toggle="tooltip" href=""
                title="Add Emoticons"><i class="far fa-smile"></i></a>
            <a class="nav-link" href=""><i class="fas fa-ellipsis-v"></i></a>
        </nav> --}}
            <input wire:model="body" class="form-control" placeholder="Type your message here..." type="text">
            <button style="border:none;outline:none;background-color:white;" type="submit" class="main-msg-send"><i
                    class="far fa-paper-plane"></i></button>
        </div>
    </form>
</div>
