<?php

/**
 * Description of Alert
 *
 * @author Lucas
 */
class Alert {
    
    private static $tiposPermitidos = array('primary', 'succes', 'danger', 'warning', 'info');

    private static function isValidType($t) {
        if (in_array($t, self::$tiposPermitidos)) {
            return true;
        }
        return false;
    }
    
    public static function getAlertByTypeAndMsg($type, $msg) {
        if (self::isValidType($type)) {
            return '<div class="alert alert-' . $type . '">' . $msg . '</div>';
        }
        return self::getAlertByTypeAndMsg('danger', 'Tipo de mensagem não encontrado! Verifique a lib/Alert');
    }

}
