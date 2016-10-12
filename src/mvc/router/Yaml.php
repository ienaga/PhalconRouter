<?php


namespace PhalconRouter;


class Yaml extends \Phalcon\Mvc\Router implements YamlInterface
{

    /**
     * @param  array $config
     * @return bool|Yaml
     */
    static function load($config = array())
    {
        $route = new static();

        if (!is_array($config) || !$config) {
            return false;
        }

        // add
        foreach ($config as $key => $values) {
            $pattern = self::createPattern($key, $values);
            $method  = self::createMethod($values);
            $paths   = self::createPaths(explode("_", $key), $values);
            $route->add($pattern, $paths, $method);
        }

        $route->handle();

        return $route;
    }

    /**
     * @param  string $key
     * @param  array  $values
     * @return string
     */
    static function createPattern($key, $values)
    {
        $pattern = (isset($values["url"]))
            ? $values["url"]
            : "/" . str_replace("_", "/", $key);

        if (strlen($pattern) > 1 && mb_substr($pattern, -1) === "/") {
            $pattern = substr($pattern, 0, -1);
        }

        return $pattern;
    }

    /**
     * @param  array $values
     * @return string|array
     */
    static function createMethod($values = array())
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
    static function createPaths($pairs = array(), $values = array())
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