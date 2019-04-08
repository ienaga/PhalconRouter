<?php

namespace Phalcon\Mvc\Router\Adapter;

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
    public static function createPattern(array $keys = array(), $values = array());

    /**
     * @param  array $values
     * @return array|string
     */
    public static function createMethod(array $values = array());

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    public static function createPaths(array $pairs = array(), array $values = array());
}