<?php


namespace PhalconRouter;


interface YamlInterface
{
    /**
     * @param  array $config
     * @return bool|Yaml
     */
    static function load($config = array());

    /**
     * @param  string $key
     * @param  array  $values
     * @return string
     */
    static function createPattern($key, $values);

    /**
     * @param  array $values
     * @return string|array
     */
    static function createMethod($values = array());

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    static function createPaths($pairs = array(), $values = array());
}