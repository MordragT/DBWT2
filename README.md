## DBWT2

- dieses Projekt beinhaltet die Pflichtaufgaben im Modul Datenbanken und Webtechnologien 2

#### Installation

- redis und postgresql müssen installiert sein
- postgresql muss initialisiert sein mit `de_DE.UTF8`

```sh
php artisan key:generate
systemctl start postgresql.service
php artisan migrate
php artisan db:seed
```

- nun muss noch die `.env` Datei enstsprechend konfiguriert werden

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=
```

#### Starten

- jeweils beide Befehle in einem eigenen Terminal

```
redis-server
php artisan serve
```

#### Präsentation

[![DBWT2 - Präsentation](https://res.cloudinary.com/marcomontalbano/image/upload/v1619555671/video_to_markdown/images/youtube--PEqSo8c88HM-c05b58ac6eb4c4700831b2b3070cd403.jpg)](https://youtu.be/PEqSo8c88HM "DBWT2 - Präsentation")

#### Hinweise

- die sicherheit war kein thema, daher passwörter in plain text anstelle von argon2, bcrypt etc.
- das Projekt wurde in Partnerarbeit durchgeführt