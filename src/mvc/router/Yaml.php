<?php

namespace PhalconRouter;

class Yaml implements YamlInterface
{

    /**
     * @param  \Phalcon\Config\Adapter\Yaml $config
     * @return \Phalcon\Mvc\Router
     */
    public static function load(\Phalcon\Config\Adapter\Yaml $config)
    {
        $router = new \Phalcon\Mvc\Router(false);
        $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

        // add
        foreach ($config as $key => $values) {
            $keys    = explode("_", $key);
            $pattern = self::createPattern($keys, $values);
            $method  = self::createMethod($values);
            $paths   = self::createPaths($keys, $values);
            $router
                ->add($pattern, $paths)
                ->setName($key)
                ->via($method);
        }

        return $router;
    }

    /**
     * @param  array  $keys
     * @param  array  $values
     * @return string
     */
    public static function createPattern($keys, $values)
    {
        $pattern = (isset($values["url"]))
            ? $values["url"]
            : "/" . implode("/", $keys);

        if (strlen($pattern) > 1 && mb_substr($pattern, -1) === "/") {
            $pattern = substr($pattern, 0, -1);
        }

        return $pattern;
    }

    /**
     * @param  array $values
     * @return mixed
     */
    public static function createMethod($values = array())
    {
        $method = "GET";
        if (isset($values["method"])) {
            $method = $values["method"];
        }

        return $method;
    }

    /**
     * @param  array $pairs
     * @param  array $values
     * @return array
     */
    public static function createPaths($pairs = array(), $values = array())
    {
        $paths = array();

        foreach ($values as $key => $value) {
            $type = strtolower($key);
            switch ($type) {
                case "namespace":
                case "controller":
                case "action":
                case "module":
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