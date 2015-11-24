## Авторизация

### Создание токена
Адрес: **/api/token**

Метод: **POST**

Параметры:

| Имя      | Тип    | Описание           |
| -------- | ------ | ------------------ |
|  login   | string | Email пользователя |
| password | string | Пароль пользователя|

Возвращаемые значения:

| Имя   | Тип    | Описание                               |
| ----- | ------ | -------------------------------------- |
| token | string | Сгенерированный токен                  |
| error | string | Текст ошибки в случае ее возникновения |

## Отзывы

### Создание отзыва
Адрес: **/api/feed**

Метод: **POST**

Параметры:

| Имя   | Тип    | Описание           |
| ----- | ------ | ------------------ |
| text  | string | Текст отзыва       |
| token | string | Токен пользователя |

Возвращаемые значения:

| Имя      | Тип    | Описание                          |
| -------- | ------ | --------------------------------- |
| id       | int    | Идентификатор созданного отзыва   |
| userId   | int    | Идентификатор автора отзыва       |
| text     | string | Текст отзыва                      |
| datetime | string | Дата отзыва в формате Y-m-d H:i:s |
| rating   | float  | Рейтинг отзыва                    |

### Редактирование отзыва
Адрес: **/api/feed**

Метод: **PUT**

Параметры:

| Имя      | Тип    | Описание                            |
| -------- | ------ | ----------------------------------- |
| reviewId | int    | Идентификатор редактируемого отзыва |
| text     | string | Текст отзыва                        |
| token    | string | Токен пользователя                  |

Возвращаемые значения:

| Имя      | Тип    | Описание                               |
| -------- | ------ | -------------------------------------- |
| id       | int    | Идентификатор созданного отзыва        |
| userId   | int    | Идентификатор автора отзыва            |
| text     | string | Текст отзыва                           |
| datetime | string | Дата отзыва в формате Y-m-d H:i:s      |
| rating   | float  | Рейтинг отзыва                         |
| error    | string | Текст ошибки в случае ее возникновения |

### Удаление отзыва

Адрес: **/api/feed**

Метод: **DELETE**

Параметры:

| Имя      | Тип    | Описание                            |
| -------- | ------ | ----------------------------------- |
| reviewId | int    | Идентификатор редактируемого отзыва |
| token    | string | Токен пользователя                  |

Возвращаемые значения:

| Имя     | Тип     | Описание                                      |
| ------- | ------- | --------------------------------------------- |
| success | boolean | Возвращается, если удаление произошло успешно |
| error   | string  | Текст ошибки в случае ее возникновения        |
