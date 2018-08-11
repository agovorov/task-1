DEMO.

Оригинальный код движка, ничего не удалено. Ветка будет удалена.



1. Установка

После запуска открывем консоль контейнера citizenzet-crm и выполняем следующие команды для инийиализации базы данных:

chmod +x /var/www/gos/ci/migrate.sh
/var/www/gos/ci/migrate.sh


2. Хосты
В файле hosts прописать:
127.0.0.1   gos

3. Авторизация
Перейти на http://gos/
Тестовый пользователь
    admin:newpassword123
    
4. В etc/host добавить 
10.10.0.218 pg3.vpn

5. В базе создать
    базу db_gos с template1 (там уже есть dblink)
 
    user: pgadmin4@pgadmin.org
    password: admin
    CREATE EXTENSION dblink;
    
    
    
    
Адреса
Адреса подгружаются из базы
  pg3.vpn:db_bilimal_v_2
    - geo.country_unit - Города, области
    - handbook.street - улицы

Demo production
    http://gos.bilimal.vpn
    admin:newpassword123

    
Так как документации по движку нет, буду записывать некоторые возможности сюда.
1. Работа с json полем.
        $model->infoJson['server_id']
    или
        это если у тебя use AttributesToInfo есть
        и метод attributesToInfo()
        и в нем возвращается ['server_id']
        тогда ты можешь писать $model->server_id и присваиваться $model->server_id = 'x'
        и в рулс пихать
    
2. Данные из бек
    \Yii::$app->data->language = \Yii::$app->language;
    
    из экшена this.controller.model.get("language")
    Yii.app.currentController.model.get("language")
    
    
    


Slow network is detected. See https://www.chromestatus.com/feature/5636954674692096 for more details. Fallback font will be used while loading: https://fonts.gstatic.com/s/ptsans/v9/jizaRExUiTo99u79D0KExQ.woff2
kid:1 Slow network is detected. See https://www.chromestatus.com/feature/5636954674692096 for more details. Fallback font will be used while loading: http://gos/assets/a37455e2/fonts/exo2/Exo2-Regular.otf
kid:1 Slow network is detected. See https://www.chromestatus.com/feature/5636954674692096 for more details. Fallback font will be used while loading: http://gos/assets/86e730fa/fonts/fontawesome-webfont.woff2?v=4.7.0
kid:1 Slow network is detected. See https://www.chromestatus.com/feature/5636954674692096 for more details. Fallback font will be used while loading: https://fonts.gstatic.com/s/ptsans/v9/jizfRExUiTo99u79B_mh0O6tLQ.woff2
kid:1 Slow network is detected. See https://www.chromestatus.com/feature/5636954674692096 for more details. Fallback font will be used while loading: https://fonts.gstatic.com/s/ptsans/v9/jizaRExUiTo99u79D0aExdGM.woff2


Get translate
./yii message-twig/extract --languages=kk-KZ --messagePath=web/messages config/translations.php
