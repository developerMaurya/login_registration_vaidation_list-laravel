<?php

$userEmail = session('user_email');
if(!$userEmail){
    echo "please login first";
    return redirect()->route('login');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>welcome to user page<h1>
    <a href="{{route('logout')}}">Logout</a>
</body>
</html>