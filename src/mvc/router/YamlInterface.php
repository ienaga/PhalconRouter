<?php


namespace PhalconRouter;


interface YamlInterface
{
    /**
     * @param  \Phalcon\Config\Adapter\Yaml $config
     * @return \Phalcon\Mvc\Router
     */
    public static function load(\Phalcon\Config\Adapter\Yaml $config);

    /**
     * @param  array  $keys
     * @param  array  $values
     * @return string
     */
    public static function createPattern($keys, $values);

    /**
     * @param  array $values
     * @return mixed
     */
    public static function createMethod($values = array());

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    public static function createPaths($pairs = array(), $values = array());
}