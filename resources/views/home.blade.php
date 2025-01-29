<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qvintus | Home</title>
    @vite('resources/css/app.css')
</head>
<body class="font-inter">
<x-navbar />
<h1 class="mt-20">Hello World</h1>
<x-footer />
@session('status')
    <x-notification type="success" title="System Notification" :body="array(session('status'))" />
@endsession
</body>
</html>