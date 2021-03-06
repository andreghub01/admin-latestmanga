
version: '3' 
services:
 web:
   build:
     context: ./
     dockerfile: web.dockerfile
   volumes:
     - ./:/var/www
   restart: always
   ports:
    - "8080:80"
   links:
    - app
 app:
   build:
     args:
       user: ubuntu
       uid: 1000
     context: ./
     dockerfile: app.dockerfile
   working_dir: /var/www/
   volumes:
     - ./:/var/www
   restart: always
   links:
     - database
   environment:
     - "DB_PORT=3306"
     - "DB_HOST=database"
  
 database:
   image: mysql:latest
   hostname: database
   restart: always
   command: --default-authentication-plugin=mysql_native_password
   environment:
       MYSQL_ROOT_PASSWORD: api_scraping
       MYSQL_DATABASE: api_scraping
   ports:
       - "33061:3306"
