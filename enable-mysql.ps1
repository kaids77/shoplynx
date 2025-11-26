# Enable MySQL Extensions in PHP
Write-Host "Enabling MySQL extensions in PHP..." -ForegroundColor Green

$phpIniPath = "C:\Users\User\php\php.ini"

# Backup the original php.ini
Copy-Item $phpIniPath "$phpIniPath.backup" -Force
Write-Host "Backup created: $phpIniPath.backup" -ForegroundColor Yellow

# Read the content
$content = Get-Content $phpIniPath

# Enable extensions
$content = $content -replace ';extension=pdo_mysql', 'extension=pdo_mysql'
$content = $content -replace ';extension=mysqli', 'extension=mysqli'

# Save the modified content
$content | Set-Content $phpIniPath

Write-Host "`nMySQL extensions enabled successfully!" -ForegroundColor Green
Write-Host "`nPlease restart your terminal and run:" -ForegroundColor Cyan
Write-Host "  php -m | findstr mysql" -ForegroundColor White
Write-Host "`nYou should see:" -ForegroundColor Cyan
Write-Host "  mysqli" -ForegroundColor White
Write-Host "  pdo_mysql" -ForegroundColor White
