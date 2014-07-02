<?php
require_once('class.arConnectorDB.php');
require_once(dirname(__FILE__) . '/../Exception/class.arException.php');
require_once(dirname(__FILE__) . '/DataBase/class.pdoDB.php');

/**
 * Class arConnectorDB
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @author  Timon Amstutz <timon.amstutz@ilub.unibe.ch>
 * @version 2.0.4
 */
class arConnectorPdoDB extends arConnectorDB {

    protected static $pbo_connect;

    protected $pdo_connect;

    /**
     * @return ilDB
     */
    protected function returnDB() {
        if(!self::$pbo_connect)
            self::$pbo_connect = new pdoDB();

        return self::$pbo_connect;
    }

    public static function getConnector(){
        return self::$pbo_connect;
    }

}
