<?php

$routeCore       = require(__DIR__ . '/route/core.php');
$routeAuth       = require(__DIR__ . '/route/auth.php');
$routeKonus      = require(__DIR__ . '/route/konus.php');
$routeAttendance = require(__DIR__ . '/route/attendance.php');
$routeMsk        = require(__DIR__ . '/route/msk.php');

$route = [

];
return array_merge($route, $routeCore, $routeAuth, $routeKonus, $routeAttendance, $routeMsk);