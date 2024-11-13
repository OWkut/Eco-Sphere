<?php

abstract class db
{
    private static $pdo;
    private static $storage;

    private static function setBdd()
    {
        $factory = (new Factory)
            ->withServiceAccount('edusphere-52d6b-firebase-adminsdk-ovunl-2924b5ced8.json')
            ->withDatabaseUri('https://edusphere-52d6b-default-rtdb.firebaseio.com/');

        self::$pdo = $factory->createDatabase();
    }

    private static function setStorage()
    {
        $factory = (new Factory)
            ->withServiceAccount('edusphere-52d6b-firebase-adminsdk-ovunl-2924b5ced8.json')
            ->withDatabaseUri('https://edusphere-52d6b-default-rtdb.firebaseio.com/');

        self::$storage = $factory->createStorage();
    }

    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }

    protected function getStorage()
    {
        if (self::$storage === null) {
            self::setStorage();
        }
        return self::$storage;
    }
}
