# My Project

## Wymagania

- Docker i Docker Compose
- Node.js (zalecana wersja LTS)
- PHP 8.2.19
- Composer

## Technologie

- PHP 8.2.19
- Vue 3
- Laravel 11
- MySQL

## Instalacja

1. Sklonuj repozytorium:
   ```bash
   git clone https://github.com/your-username/your-repository.git
   cd your-repository
   ```

2. Skopiuj plik .env.example do .env:
   ```bash
   cp .env.example .env
   ```

3. Zaktualizuj plik .env zgodnie z wymaganiami.

4. Uruchom kontenery Dockera oraz zainstaluj zależności PHP i Node.js:
   ```bash
   docker-compose up -d
   docker-compose exec app composer install
   docker-compose exec app php artisan key:generate
   npm install
   ```

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

## Dostępne komendy Docker

- `docker-compose up -d` - uruchomienie kontenerów w tle
- `docker-compose down` - zatrzymanie i usunięcie kontenerów
- `docker-compose exec app bash` - dostęp do kontenera aplikacji

## Konfiguracja

Plik konfiguracyjny .env zawiera wszystkie niezbędne ustawienia do uruchomienia aplikacji. Upewnij się, że wszystkie ustawienia są poprawne, szczególnie dotyczące bazy danych:

```plaintext
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Struktura katalogów

- `app/` - katalog aplikacji Laravel
- `public/` - katalog publiczny, punkt wejścia aplikacji
- `resources/` - zasoby Vue.js
- `database/` - migracje i seedy bazy danych
```
