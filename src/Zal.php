<?php

namespace arashrasoulzadeh\Zal;

use ReflectionClass;

class Zal
{
    public static $actions = [];

    public static function RegisterAction(string $action_class, ?string $route = null)
    {
        $route = self::generateRouteName($route, $action_class);
        self::$actions[$route] = $action_class;
    }

    public static function getActions()
    {
        return self::$actions;
    }

    private static function generateRouteName($route, $action)
    {
        if ($route == null) {
            $reflect = new ReflectionClass($action);
            $name = '';
            $namespaceArray = explode('\\', $reflect->getName());
            $nameArray = [];
            for (end($namespaceArray); key($namespaceArray) !== null; prev($namespaceArray)) {
                $currentElement = current($namespaceArray);
                if ($currentElement == 'Actions') {
                    break;
                }
                $currentElement = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $currentElement));
                $nameArray[] = strtolower($currentElement);
            }
            $route = implode('-', array_reverse($nameArray));
        }

        return $route;
    }
}
