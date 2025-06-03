# Instrukcja uruchomienia projektu Homeiq

## Wymagania wstępne
- Docker i Docker Compose
- Git

### Pierwsze uruchomienie
Należy wykonać kroki 1-4 z poniższek instrukcji. Pierwsze uruchomienie wymaga pełnej konfiguracji środowiska.
## Krok 1: Klonowanie repozytorium
```bash
git clone https://github.com/GrabarskaGabriela/Homeiq
cd Homeiq
```

## Krok 2: Przygotowanie środowiska
1. Należy upewnić się, że porty 3306, 8080, 8081 są wolne na naszym komputerze.

2. Uruchom kontenery Docker:
```bash
docker-compose build 
docker-compose up -d
```

## Krok 3: Konfiguracja projektu
Po uruchomieniu kontenerów należy otworzyć terminal i wykonać poniższe polecenia w celu uruchominia specjalnie przygotowane skryptu ułatwiającego przygotowanie środowiska:

```shell
# Należy wejść do kontenera aplikacji
docker exec -it homeiq-app-1 bash

# Należy nadać skryptowi start uprawnienia do uruchamiania
chmod +x start.sh

# Uruchamiamy skrypt
./start.sh 

```

Można również wykonać polecenia ze skryptu ręcznie:

```bash
# Należy wejść do kontenera aplikacji
docker exec -it homeiq-app-1 bash

# Instacja zależności composer
composer install

# Instalacja zależności npm
npm install

# Wykonujemy migracje w celu utworzenia tabel relacyjnej bazy danych
php artisan migrate

# Generujemy klucz aplikacji 
php artisan key:generate

# Dodajemy testowe dane do aplikacji
php artisan db:seed

# Stwórz link symboliczny dla zdjęć profilowych
php artisan storage:link

# Należy nadać uprawnienia do storage
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Skompiluj zasoby (dla produkcji)
npm run build
```

## Krok 5: Dostęp do aplikacji
- Aplikacja Laravel: http://localhost:8080
- Baza danych MySQL: http://localhost:8081

### Zakończenie pracy środowiska
```bash
docker-compose down
```

### Całkowite usunięcie środowiska wraz z danymi
```bash
docker-compose down -v
```
## Struktura projektu
- `environment/dev/app/` - pliki konfiguracyjne Docker
- `src/` - kod źródłowy Laravel
- `src/resources/js/components/` - komponenty Vue.js
- `src/resources/css/` - pliki CSS i SCSS
