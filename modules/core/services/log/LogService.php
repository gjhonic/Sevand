<?php
/**
 * LogService
 * Сервис логирования
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services\log;

use app\modules\core\models\base\Log;
use app\modules\core\models\base\User;
use Yii;
use yii\web\NotFoundHttpException;

class LogService
{
    /**
     * Добавления лога
     * @param int $status_id тип лога (STATUS_INFO, STATUS_SUCCESS, STATUS_WARNING, STATUS_DANGER)
     * @param int $user_id id Пользователя
     * @param string $message короткое сообщение из LogMessage
     * @param string $description описание лога
     * @return bool
     * @throws NotFoundHttpException
     */
    public static function createLog(
        int $status_id,
        int $user_id,
        string $message,
        string $description = ''
    ): bool
    {
        if (!in_array($status_id, Log::getStatusesIds())) {
            self::createWarningFileLog(
                LogMessage::WARNING_MESSAGE_STATUS_NOT_FOUND . ' status_id: ' . $status_id
            );
            return false;
        }

        $user = User::findOne(['id' => $user_id]);

        if (!$user) {
            self::createWarningFileLog(LogMessage::WARNING_MESSAGE_USET_NULL . ' user_id: ' . $user_id);
            return false;
        }

        $log = new Log();
        $log->user_id = $user_id;
        $log->department_id = $user->department_id;
        $log->status_id = $status_id;
        $log->message = $message;
        $log->description = $description;

        if ($log->save()) {
            return true;
        } else {
            self::createWarningFileLog(LogMessage::WARNING_MESSAGE_LOG_NOT_CREATED);
            return false;
        }
    }

    /**
     * Метод пишет warning Лог в файл
     * @param string $text
     */
    private static function createWarningFileLog(string $text)
    {
        Yii::warning($text);
    }
}