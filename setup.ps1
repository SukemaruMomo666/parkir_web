$ErrorActionPreference = 'Stop'

Write-Host "Creating Laravel project in temp directory..."
composer create-project laravel/laravel nusa_temp

Write-Host "Moving files to root..."
Move-Item -Path .\nusa_temp\* -Destination .\ -Force
Move-Item -Path .\nusa_temp\.* -Destination .\ -Force -ErrorAction SilentlyContinue

Write-Host "Cleaning up temp directory..."
Remove-Item -Path .\nusa_temp -Recurse -Force

Write-Host "Setting up CSS..."
if (-not (Test-Path -Path .\public\css)) {
    New-Item -ItemType Directory -Force -Path .\public\css | Out-Null
}
Move-Item -Path .\style.css -Destination .\public\css\style.css -Force

Write-Host "Setting up Blade view..."
Move-Item -Path .\index.php -Destination .\resources\views\welcome.blade.php -Force

Write-Host "Setup completed successfully!"
