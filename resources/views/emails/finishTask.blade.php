<html>
<head></head>
<body style="text-align:center">
    <div style="background:#f3f3f3; margin-bottom:-1px;">
        <h2 style="padding-top:10px; padding-bottom:10px;">Hello Admin,</h2>
    </div>
    <hr>
<p>The employee {{$name}} has finished the task:<a style="text-decoration:none; color:initial;" href='http://127.0.0.1:8000{{$link}}'>{{$title}} </a> that was due on {{$deadline}}. </p>

<a href="http://127.0.0.1:8000{{$link}}" style="-webkit-appearance: button;text-decoration:none; color:white; background:seagreen; padding:10px">Go to task</a>
</body>
</html>