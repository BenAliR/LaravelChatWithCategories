@foreach($messages as $message)
    <ul class="list-unstyled"  >
        <li class="media mb-3">

            <div class="media-body">
                <h6 class="mt-0 text-primary mb-1">Utilisateur</h6>
                <p>{{ $message->prompt }}</p>
                <small class="text-muted">{{ $message->created_at->format('d M Y H:i:s') }}</small>
            </div>
        </li>
        <li class="media">

            <div class="media-body" id="message-{{$loop->index}}">
                <h6 class="mt-0 text-info mb-1">Open AI</h6>
                <p >{{ $message->response }}</p>
                <small class="text-muted">{{ $message->created_at->format('d M Y H:i:s') }}</small>
            </div>
        </li>
    </ul>
@endforeach
<script>
    // Scroll to the bottom of the chat-messages div
    var chatMessages = document.getElementById('chat-messages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>
