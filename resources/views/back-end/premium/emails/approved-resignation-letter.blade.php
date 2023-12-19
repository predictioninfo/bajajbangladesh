<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body,
        div {
            font-family: nikosh;
        }

        .increment-letter {
            padding-left: 30px;
            padding-right: 30px;
            font-size: 20px;
            text-align: justify;
        }

        ol {
            list-style-type: bengali;
        }
    </style>
</head>

<body>

    <div class="increment-letter" style="font-size:20px;">
        <br>
        <p>
            @foreach($request_sender_name as $request_sender_name)
            {{ $request_sender_name }}
            @endforeach
            @foreach($status as $status)
            {{ $status }}
            @endforeach
            .
        </p><br>
        <br><br>

</body>

</html>