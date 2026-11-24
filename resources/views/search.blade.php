<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Find Parking - NusaPark</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="search-layout-body">
    <!-- PUBLIC NAVBAR (Reused from Page 01) -->
    <x-navbar active="search" />

    <!-- SHARED DISCOVERY COMPONENT (PUBLIC) -->
    <x-parking-discovery :isAuthenticated="false" />
</body>
</html>
