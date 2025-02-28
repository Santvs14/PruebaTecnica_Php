up:
  docker-compose up --build
down:
  docker-compose down

  docker:
      docker exec -it php_app bash

Tests PHPUnit:
     composer dump-autoload -o          //Conteo de Class
     php vendor/bin/phpunit tests //Todas las pruebas
     //Ejecuta la prueba  UserTest



