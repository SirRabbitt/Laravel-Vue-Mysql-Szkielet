# Zadanie rekrutacyjne 
https://zadanierekrutacyjne.site/

## Wymagania

- Node.js (zalecana wersja LTS)
- PHP 8.2.19
- Composer

## Technologie

- Vue 3
- Laravel 11
- MySQL



## Uruchamianie aplikacji

- Uruchom serwer aplikacji Laravel:
   ```bash
   docker-compose exec app php artisan serve
   ```

- Uruchom środowisko developerskie Vue:
   ```bash
   npm run dev
   ```

Aplikacja będzie dostępna pod adresem http://localhost:8000.

## Docker Compose

Aby uruchomić wszystkie usługi jednocześnie:
```bash
docker-compose up -d
```

## Migracje bazy danych

Aby uruchomić migracje bazy danych:
```bash
docker-compose exec app php artisan migrate
```


