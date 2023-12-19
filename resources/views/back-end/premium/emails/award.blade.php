<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Award</title>
</head>
<body style="background:rgb(218, 219, 171);text-align:center;">
<div style="padding: 20%;">
<p style="text-align:center;font-size:25px;">Congratulations! {{$sender_name}},You have won a award.Please visit your  account to see your award details <a href="{{route('employee-award')}}">{{ Auth::user()->company->company_name}} Link</a></p>
</div>

</body>
</html>
