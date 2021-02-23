# Colors manager

Simple app integrating:
- Lumen Framework (Laravel micro-framework)
- Vue.JS

Steps to run (steps 5-8 are not necessary when using sqlite database and compiled files from repo):
1. clone repository
2. run: docker-compose up --build
3. run: mv .env.example .env
4. run: composer install
5. run: php artisan migrate
6. run: php artisan db:seed --class UsersSeeder
7. run: php artisan db:seed --class ColorsTableSeeder
8. run: npm install
9. Display page: localhost:8080/

![Demo image](https://raw.githubusercontent.com/jorgsowa/Lumen-vuejs-app/main/resources/demo.png)
