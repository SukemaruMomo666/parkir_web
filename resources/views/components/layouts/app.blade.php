<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'NusaPark - Smart Parking for a Smarter Indonesia' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="text-[var(--text)] bg-[var(--background)] antialiased min-h-screen flex flex-col pb-24 md:pb-8 relative">
    
    @if(isset($activeNav))
        <x-auth-navbar :active="$activeNav" />
    @endif

    <main class="{{ $containerClass ?? 'flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 space-y-6 md:space-y-8' }}">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
