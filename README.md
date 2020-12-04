Для того чтобы развернуть выполнить следующие инструкции:
```
git clone git@github.com:kolo6ok/test-weather-site.git
npm install 
npm run dev
docker-compose up --build -d
docker-compose exec php composer install
```
Далее переходим на [localhost:8081](http://localhost:8081).

P.S: Если запускать из под linux то надо в файле .env в `URL_WEATHER` заменить `host.docker.internal` на `172.17.0.1`.
