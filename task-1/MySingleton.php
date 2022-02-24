<?php

declare(strict_types=1);

class MySingleton
{
    /**
     * @var array
     */
    private static array $instances = [];

    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup()
    {
        throw new LogicException('Синглтон не может быть сериализован');
    }

    /**
     * @return MySingleton
     */
    public static function getInstance(): MySingleton
    {
        $singleton = static::class;

        if (!isset(self::$instances[$singleton])) {
            self::$instances[$singleton] = new static();
        }

        return self::$instances[$singleton];
    }
}

$singletonFirst = MySingleton::getInstance();
$singletonSecond = MySingleton::getInstance();

if ($singletonFirst === $singletonSecond) {
    echo 'Синглтон вернул один и тот же экземпляр. Работает';
} else {
    echo 'Синглтон вернул разные экземпляры. Не работает';
}