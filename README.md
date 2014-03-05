extJS
===
Установка:
<br>
1) Скопировать проект с репозитория
<br>
git clone https://github.com/smileface/extJS.git
<br>
2) Перейти в каталог проекта extJS/
<br>
3) Установить Yii framework
<br>
php composer.phar update
<br>
4) Изменить права доступа для каталога runtime/
<br>
sudo chmod -R 777 protected/runtime
<br>
5) Создать БД 'ext' и применить миграции:
<br>
protected/yiic migrate

Каталог проекта /var/www/extJS
