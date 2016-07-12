# doctors_appointments
Это демо приложение для обеспечения записи клиента к врачу посредством веб-сайта. Приложение построено на базе фреймворка Yii2

# Реализация

## Модель данных и связи

Отражены на следующей ER диаграмме
![alt text](https://github.com/sergshner/doctors_appointments/blob/master/docs/data_model.png "Data model")

Для такого рода данных вполне хорошо подходит распространённая реляционная СУБД MySQL. Она и использована в проекте.

## Миграции

Для изменения и поддержания структуры базы данных а актуальном состоянии в проекте используется механизм миграций, в частности, его реализация, встроенная в Yii2 фреймворк. (см. папку migrations)


