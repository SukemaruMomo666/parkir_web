<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Parking Near You - NusaPark</title>
    <meta name="description" content="Discover available parking, compare prices, and navigate directly to your destination across Indonesia.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col">
    <!-- NAVBAR -->
    <x-navbar active="search" />

    <!-- MAIN DISCOVERY CONTENT -->
    <div class="flex-1 w-full">
        <x-parking-discovery :isAuthenticated="false" />
    </div>

    <!-- FOOTER -->
    <x-footer />
</body>
</html>
