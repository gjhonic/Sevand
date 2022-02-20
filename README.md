# ПРОЕКТ ИС "СЕВАНД"
________________


# Инструкции для добавления новых модулей


----------------------

## Модули складываем 
```
modules
    - core
    - attendance
    - konus
    - {module_name}
```

## Роутинг на модули
```
1. Создать файл в config/route/{module_name}.php
2. Добавить в файле config/route.php

+ $route{Module_name} = require(__DIR__ . '/route/{module_name}.php');
>> return array_merge($route, $routeCore, ..., $route{Module_name});
```

## Модульные миграции
`````
Создание:
php yii migrate/create --migrationPath=@modules/{module_name}/migrations

Запуск:
php yii migrate --migrationPath=@modules/{module_name}/migrations
```