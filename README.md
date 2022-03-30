# Control Panel For Astra Cesbo 4.4.187 on PHP 7
Реализовал на PHP с AJAX. Мониторинг , все дела. 
Функции :
```
- Сохранение конфига 
- Перезапуск астры
- Мониторинг (через lua скрипт отправляются данные на сервер)
```
Установка простая:

```
apt-get update && apt-get upgrade -y
```
```
apt install -y nginx mysql-server php-fpm php-mysql php
```
далее: 
```
mysql -u <Users> -p<Passwd>
В мускуле:
create database astra;
quit
```
Потом:
```
cd /var/www/html
mysql  -u <Users> -p<Passwd> astra < astra.sql
```
В Sudoers еще надо внести разрешения для выполнения скрипта:
```
mcedit /etc/sudoers
www-data        ALL=(root) NOPASSWD:/etc/init.d/astra4
```
Все фалы лежат в ``src``. 
```
Если есть идеи подкиньте https://t.me/fant1kus 
```
Любая критика приветствуется. Писал для себя для удобства, может что то не доглядел. Буду править и поддерживать репу пока возможно

