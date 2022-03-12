<?php
/**
 * LogService
 * Сервис логирования
 * @copyright Copyright (c) 2022 Eugene Andreev
 * @author Eugene Andreev <gjhonic@gmail.com>
 */

namespace app\modules\core\services;

use app\modules\core\models\base\Log;
use app\modules\core\models\base\User;
use Yii;
use yii\web\NotFoundHttpException;

class LogService
{
    //Статусы логов
    const STATUS_INFO = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_WARNING = 3;
    const STATUS_DANGER = 4;
    const STATUS_CRAZY = 5;

    //Сообщения Warning логов
    const WARNING_MESSAGE_STATUS_NOT_FOUND = 1;
    const WARNING_MESSAGE_USET_NULL = 2;
    const WARNING_MESSAGE_LOG_NOT_CREATED = 3;

    /**
     * Возвращает массив статусов
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_INFO,
            self::STATUS_SUCCESS,
            self::STATUS_WARNING,
            self::STATUS_DANGER,
            self::STATUS_CRAZY,
        ];
    }

    /**
     * Массив сообщений
     * @return array
     */
    public static function getMessages(): array
    {
        return [
            self::WARNING_MESSAGE_STATUS_NOT_FOUND => 'Log not created because status not found.',
            self::WARNING_MESSAGE_USET_NULL => 'The log was not created because the user was not found.',
            self::WARNING_MESSAGE_LOG_NOT_CREATED => 'The log was not created.',
        ];
    }

    /**
     * Возвращает текст ошибки
     * @param int $message_id
     * @return string
     */
    public static function getMessage(int $message_id): string
    {
        return self::getMessages()[$message_id];
    }

    /**
     * Добавления лога
     * @param int $status_id тип лога (STATUS_INFO, STATUS_SUCCESS, STATUS_WARNING, STATUS_DANGER)
     * @param int $user_id
     * @param string $message короткое сообщение
     * @param string $description описание лога
     * @return bool
     * @throws NotFoundHttpException
     */
    public static function createLog(
        int $status_id = self::STATUS_INFO,
        int $user_id = User::USER_SYSTEM_ID,
        string $message = '',
        string $description = ''
    ): bool {
        $user = User::findOne(['id' => $user_id]);

        if (!in_array($status_id, self::getStatuses())) {
            $resultSave = self::createWarningLog(self::WARNING_MESSAGE_STATUS_NOT_FOUND, 'status_id: ' . $status_id);
            if ($resultSave) {
                return false;
            } else {
                self::createWarningFileLog(
                    self::getMessage(self::WARNING_MESSAGE_STATUS_NOT_FOUND) . ' status_id: ' . $status_id
                );
                return false;
            }
        }

        if (!$user) {
            $resultSave = self::createWarningLog(self::WARNING_MESSAGE_USET_NULL, 'user_id: ' . $user_id);
            if ($resultSave) {
                return false;
            } else {
                self::createWarningFileLog(self::getMessage(self::WARNING_MESSAGE_USET_NULL) . ' user_id: ' . $user_id);
                return false;
            }
        }

        $log = new Log();
        $log->user_id = $user_id;
        $log->department_id = $user->department_id;
        $log->status_id = $status_id;
        $log->message = $message;
        $log->description = $description;

        if (!$log->save()) {
            self::createWarningFileLog(self::getMessage(self::WARNING_MESSAGE_LOG_NOT_CREATED));
            return false;
        } else {
            return true;
        }
    }

    /**
     * Метод создает warning лог
     * @param int $message_id
     * @param string $text
     * @return bool
     */
    private static function createWarningLog(int $message_id, string $text): bool
    {
        $logWarning = new Log();
        $logWarning->user_id = User::USER_SYSTEM_ID;
        $logWarning->department_id = 0;
        $logWarning->status_id = self::STATUS_WARNING;
        $logWarning->message = self::getMessage($message_id);
        $logWarning->description = $text;

        if (!$logWarning->save()) {
            self::createWarningFileLog(self::getMessage(self::WARNING_MESSAGE_LOG_NOT_CREATED));
            return false;
        }
        return true;
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