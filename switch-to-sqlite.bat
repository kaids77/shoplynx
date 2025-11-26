@echo off
echo Updating .env to use SQLite...

powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=mysql', 'DB_CONNECTION=sqlite' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^DB_HOST=', '#DB_HOST=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^DB_PORT=', '#DB_PORT=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^DB_DATABASE=', '#DB_DATABASE=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^DB_USERNAME=', '#DB_USERNAME=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace '^DB_PASSWORD=', '#DB_PASSWORD=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'CACHE_STORE=database', 'CACHE_STORE=file' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'SESSION_DRIVER=database', 'SESSION_DRIVER=file' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'QUEUE_CONNECTION=database', 'QUEUE_CONNECTION=sync' | Set-Content .env"

echo Done! .env updated to use SQLite.
echo Your MySQL settings have been backed up to .env.mysql.backup
