@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

<x-layouts.app activeNav="search" containerClass="flex-1 min-h-0 flex flex-col md:pb-0 pb-16 h-full px-0">
    <x-parking-discovery :isAuthenticated="true" />
</x-layouts.app>
