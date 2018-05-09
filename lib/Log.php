<?php

/**
 * Description of Log
 *
 * @author Lucas
 */
class Log {

    private static $msgPadrao = 'Log Remoto:\n';

    public static function insertLog($msg) {
        return '<script>console.log("' . self::$msgPadrao . $msg . '");</script>';
    }

}
