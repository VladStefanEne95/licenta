<html>
<head></head>
<body style="text-align:center">
    <div style="background:#f3f3f3; margin-bottom:-1px;">
        <h2 style="padding-top:10px; padding-bottom:10px;">Hello {{$name}},</h2>
    </div>
    <hr>
<p>You have been asigned a new task:<a style="text-decoration:none; color:initial;" href='http://127.0.0.1:8000{{$link}}'>{{$title}}</a></p>
{!!$description!!}
<p> The task is due on {{$deadline}}. </p>

<a href="http://127.0.0.1:8000{{$link}}" style="-webkit-appearance: button;text-decoration:none; color:white; background:seagreen; padding:10px">Go to task</a>
</body>
</html>