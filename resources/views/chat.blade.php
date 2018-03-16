
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Chatroom</title>

        <link rel="stylesheet" href="css/app.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
    @include('inc.navbar')
        <div id="app">
            <h1>Chat</h1>
            <span class="badge pull-right">@{{ usersInRoom.length }}</span>
            <chat-log :messages="messages"></chat-log>
            <chat-composer current-user="{{ Auth::user()->name }}" v-on:messageSent="addMessage"></chat-composer>
        </div>
        <script src="js/app.js" charset="utf-8"></script>
    </body>
</html>