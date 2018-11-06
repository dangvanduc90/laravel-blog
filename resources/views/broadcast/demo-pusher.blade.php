<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Pusher - Trung Quân</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css" media="screen">
        #messages{
            color: #1abc9c;
        }
        #messages li{
            max-width: 50%;
            margin-bottom:10px;
            border-color: #34495e;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h1>Laravel & Pusher: Demo real-time web application.</h1>
        <small>
            Author: <a href="https://trungquandev.com/" target="__blank">https://trungquandev.com/</a>
        </small><br><br>

        <p>Message preview:</p>
        <ul id="messages" class="list-group"></ul>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        // Khởi tạo một đối tượng Pusher với app_key
        Pusher.logToConsole = true;

        var pusher = new Pusher(`{{ env('PUSHER_APP_KEY') }}`, {
            cluster: `{{ env('PUSHER_APP_CLUSTER') }}`,
            forceTLS: true
        });

        //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file DemoPusherEvent.php
        var channel = pusher.subscribe('channel-demo-real-time');

        //Bind một function addMesagePusher với sự kiện DemoPusherEvent
        channel.bind('my-event', addMessageDemo);
    });

    //function add message
    function addMessageDemo(data) {
        console.log(data);
        var liTag = $("<li class='list-group-item'></li>");
        liTag.html(data.message);
        $('#messages').append(liTag);
    }
</script>
</body>
</html>