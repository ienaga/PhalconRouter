<?php

namespace Phalcon\Mvc\Router\Adapter;

class Yaml implements YamlInterface
{

    /**
     * @param  \Phalcon\Config\Adapter\Yaml $config
     * @return \Phalcon\Mvc\Router
     */
    public static function load(\Phalcon\Config\Adapter\Yaml $config): \Phalcon\Mvc\Router
    {
        $router = new \Phalcon\Mvc\Router(false);
        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

        // router add
        foreach ($config as $key => $values) {
            $keys    = explode("_", $key);
            $pattern = self::createPattern($keys, $values);
            $method  = self::createMethod($values);
            $paths   = self::createPaths($keys, $values);
            $router
                ->add($pattern, $paths, $method)
                ->setName($key);
        }

        return $router;
    }

    /**
     * @param  \Phalcon\Mvc\Router $router
     * @param  \Phalcon\Config\Adapter\Yaml $config
     * @return \Phalcon\Mvc\Router
     */
    public static function add(\Phalcon\Mvc\Router $router, \Phalcon\Config\Adapter\Yaml $config): \Phalcon\Mvc\Router
    {
        // router add
        foreach ($config as $key => $values) {
            $keys    = explode("_", $key);
            $pattern = self::createPattern($keys, $values);
            $method  = self::createMethod($values);
            $paths   = self::createPaths($keys, $values);
            $router
                ->add($pattern, $paths, $method)
                ->setName($key);
        }

        return $router;
    }

    /**
     * @param  array  $keys
     * @param  array  $values
     * @return string
     */
    public static function createPattern(array $keys = array(), array $values = array()): string
    {
        $pattern = (isset($values["url"]))
            ? $values["url"]
            : "/" . implode("/", array_slice($keys, 0, 2));

        if (strlen($pattern) > 1) {
            // set top slash
            if (mb_substr($pattern, 0, 1) !== "/") {
                $pattern = "/". $pattern;
            }

            // delete end slash
            if (mb_substr($pattern, -1) === "/") {
                $pattern = substr($pattern, 0, -1);
            }
        }

        return $pattern;
    }

    /**
     * @param array $values
     * @return array|string
     */
    public static function createMethod(array $values = array())
    {
        if (!isset($values["method"])) {
            return "GET";
        }

        $methods = $values["method"];
        return  (is_string($methods)) ? $methods : $methods->toArray();
    }

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    public static function createPaths(array $pairs = array(), array $values = array()): array
    {
        $paths = array();

        foreach ($values as $key => $value) {
            $type = strtolower($key);
            switch ($type) {
                case "namespace":
                case "module":
                case "controller":
                case "action":
                    $paths[$type] = $value;
                    break;
            }
        }

        if (!isset($paths["controller"])) {
            $paths["controller"] = $pairs[0];
        }

        if (!isset($paths["action"])) {
            $paths["action"] = isset($pairs[1]) ? $pairs[1] : "index";
        }

        return $paths;
    }
}