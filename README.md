# Version
PHP Version 5.6.40

# Database
mysql 5.7

# Инструкция по развороту локальной копии:

## Git
  ___Клонируем репозиторий с проектом:___  
  1. git clone  https://github.com/rusavtomatika-spb/rusavtomatika.git

## Mysql
  ___Создаем локальную БД в mysql:___  
  1. mysql -u root -p123456  
  2. create database weintek_db;  
  ___Добавляем дамп в локальную БД:___  
  1. mysql -u root -p123456 rusavtomatika_db < export/dump.sql  
  

## Config
  ___Подключаем конфиги:___  
  1. /index.php
  2. /sc/dbcon.php
  3. /sc/lib_new.php
  4. В файле /abacus/application/CoreApplication.php нужно раскомментировать блок "Для локальной копии указываем полные пути для загрузки стилей и скриптов"