# ПРОЕКТ ИС "СЕВАНД"
________________
Система ежедневного внутрифакультетского анализа неявок и достижений

**Инструкция по установке**

1) Loading the script
```
git clone git@github.com:gjhonic/sevand.git
```

2) Create a .env file and copy the contents from .env.sample
- /config/.env


3) Update Packages
```
composer update
```

4) Start migration
```
yii migrate --migrationPath=@yii/rbac/migrations
yii migrate --migrationPath=@modules/core/migrations
```



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
```
Создание:
php yii migrate/create {migtaration_name} --migrationPath=@modules/{module_name}/migrations

Запуск:
php yii migrate --migrationPath=@modules/{module_name}/migrations
```