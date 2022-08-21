<?php

class Model
{
    public static $sql = '';

    public function __construct()
    {
        $serverName = 'localhost';
        $userName = 'root';
        $password = '';
        ## Change the value of $dbName according to the connected database
        $dbName = 'database_name';
        self::$sql = new PDO('mysql:host=' . $serverName . ';dbname=' . $dbName, $userName, $password);
        self::$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$sql->exec('set names utf8');
    }
//query methods
    public function doQuery($sql, $values = [])
    {
        $query = self::$sql->prepare($sql);
        foreach ($values as $key => $item) {
            $query->bindValue($key + 1, $item);
        }
        $query->execute();
    }

    public function doSelect($sql, $values = [], $fetch = '')
    {
        $query = self::$sql->prepare($sql);
        foreach ($values as $key => $item) {
            $query->bindValue($key + 1, $item);
        }
        $query->execute();
        if ($fetch === '') {
            return $query->fetchAll();
        } else {
            return $query->fetch();
        }
    }
}