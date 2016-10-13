<?php


namespace PhalconRouter;


interface YamlInterface
{
    /**
     * @param  array $config
     * @return bool|Yaml
     */
    public static function load($config = array());

    /**
     * @param  string $key
     * @param  array  $values
     * @return string
     */
    public static function createPattern($key, $values);

    /**
     * @param  array $values
     * @return string|array
     */
    public static function createMethod($values = array());

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    public static function createPaths($pairs = array(), $values = array());
}