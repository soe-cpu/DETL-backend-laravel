## Running Project

To run project, run the following command

&nbsp; 1. Clone the Repository

```bash
  https://github.com/soe-cpu/DETL-backend-laravel.git

  cd DETL-backend-laravel
```

&nbsp; 2. Install requirements

```bash
  composer install
```

```bash
  npm install
```

&nbsp; 3. Copy .env.example

```bash
  cp .env.example .env
```

&nbsp; 4. Create your database and connect in env config

&nbsp; 5. Generate app key

```bash
  php artisan key:generate
```

&nbsp; 6. Migration

```bash
  php artisan migrate

```

&nbsp; 7. Run Project

```bash
  php artisan serve

  npm run dev

```

&nbsp; 7. Api is running on http://localhost:8000/api/
