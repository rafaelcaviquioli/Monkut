<?php

use \Config;

class Connection {

    static $instance;
    static $db;

    static function getConnection() {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new MongoClient();
            }
            return self::$instance;
        } catch (Exception $e) {
            throw $e;
        }
    }

    static function getDB() {
        try {
            if (!isset(self::$db)) {
                self::$db = self::getConnection()->meudb;
            }
            return self::$db;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
