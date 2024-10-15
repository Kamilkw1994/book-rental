Instrukcja uruchomienia aplikacji CRUD na docker:
1. W konsolli musimy przejść do folderu, w którym znajduje się projekt CRUD,a. następnie wkleić docker compose build, a następnie kliknąć enter.
2. Nastepnie w konsoli należy wkleić docker compose up -d , a następnie kliknąć enter.
3. Nazwe pliku .env.example zmienić na .env
4. W konsoli wkleić: docker compose run --rm www composer install.
5. W konsoli wkleić: docker compose run --rm www php artisan migrate
6. W konsoli wkleić: docker compose run --rm www php artisan db:seed --class=BookSeeder
7. W konsoli wkleić: docker compose run --rm www php artisan db:seed --class=ClientSeeder
Testy przeprowadzamy poprzez:
W konsoli wkleić: docker compose run --rm www php artisan test
UWAGA! Z uwagi na czas przygotowania aplikacji testy dostosowane są do ilości danych, które dostarczone zostaną do aplikacji poprzez seedery.
Dlatego też istotne jest, by przed uruchomieniem testów aplikacji wykonać punkty 6 oraz 7.
8. Poniżej opis Endpoint'ów aplikacji: 
GET /api/books
    Opis: Listowanie książek z paginacją i możliwością wyszukiwania.
    Parametry: search (opcjonalny)

GET /api/books/{id}
    Opis: Szczegóły książki.
    
POST /api/books/{id}/rent
    Opis: Wypożyczenie książkę.
    Parametry: client_id (ID klienta)

PUT /api/books/{id}/return
    Opis: Oddanie książki.

GET /api/clients
    Opis: Listowanie klientów.

GET /api/clients/{id}
    Opis: Szczegóły klienta.

POST /api/clients
    Opis: Dodanie klienta.
    Parametry: first_name, last_name

DELETE /api/clients/{id}
    Opis: Usunięcie klienta.

9. UWAGA: Jeśli wystąpi błąd: 
"The stream or file "/www/storage/logs/laravel.log" could not be opened in append mode: Failed to open stream: Permission denied"
Należy wykonać następujące instrukcje: chmod 777 storage/logs/laravel.log, a następnie sudo chmod 777 -R storage/framework