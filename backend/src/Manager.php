<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 14:54
 */

namespace App;


use Slim\Exception\ContainerException;

class Manager {
    /** @var \Slim\Container */
    protected static $di;

    public static function setDi(\Slim\Container $di) {
        self::$di = $di;
    }

    public static function getDi(): \Slim\Container {
        return self::$di;
    }

    /**
     * @param $name
     * @throws \Interop\Container\Exception\ContainerException
     */
    public static function getClassInstance($name, $data= null) {
        $di = self::getDi();
        if ($di->has($name)){
            $class = $di->get($name);
            if(is_string($class)){
                $class = new $class($di, $data);
            }
            if (is_object($class)){
                if(method_exists($class,'setData')){
                    $class->setData($data);
                }
                return $class;
            }
            throw new ContainerException("Class $name not found");
        }
        $parts = explode('.',$name);
        if (count($parts) === 2){
            $class = 'App\\'.ucfirst($parts[0]).'\\'.ucfirst($parts[1]);
            if (class_exists($class)){
                if(is_string($class)){
                    $class = new $class($di, $data);
                }
                if (is_object($class)){
                    if(method_exists($class,'setData')){
                        $class->setData($data);
                    }
                    return $class;
                }
            }
        }
        throw new ContainerException("Class $name not found");
    }
}