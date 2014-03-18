Tutorial-extJS
===
#### Установка:
1) Скопировать проект с репозитория
```bash
git clone https://github.com/smileface/Tutorial-extJS.git
```
2) Перейти в каталог проекта Tutorial-extJS/
<br>
3) Установить Yii framework
```bash
php composer.phar update
```
4) Изменить права доступа для каталога runtime/
```bash
sudo chmod -R 777 protected/runtime
```
5) Создать БД 'ext' и применить миграции:
```bash
protected/yiic migrate
```
Каталог проекта /var/www/Tutorial-extJS
