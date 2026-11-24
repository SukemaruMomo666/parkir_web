$ErrorActionPreference = 'Stop'
Write-Host "Installing Laravel Boost..."
composer require laravel/boost --dev
php artisan boost:install
Write-Host "Boost installation complete!"
