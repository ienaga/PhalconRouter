<?php

require_once __DIR__ . "/../src/Phalcon/mvc/router/adapter/Yaml.php";

use Phalcon\Mvc\Router\Adapter\Yaml;

class YamlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * createMethod case empty values
     */
    public function testCreatePatternEmptyValues()
    {
        $pattern = Yaml::createPattern(
            array(
                "member",
                "create"
            ),
            new Phalcon\Config(array())
        );

        $this->assertEquals("/member/create", $pattern);
    }

    /**
     * createMethod case plural keys and empty values
     */
    public function testCreatePatternPluralKeysAndEmptyValues()
    {
        $pattern = Yaml::createPattern(
            array(
                "member",
                "list",
                "all"
            ),
            new Phalcon\Config(array())
        );

        $this->assertEquals("/member/list", $pattern);
    }

    /**
     * createMethod case empty keys
     */
    public function testCreatePatternEmptyKeys()
    {
        $pattern = Yaml::createPattern(
            array(),
            new Phalcon\Config(array(
                "url" => "/member/update"
            ))
        );
        $this->assertEquals("/member/update", $pattern);
    }

    /**
     * createMethod case empty keys and top not slash
     */
    public function testCreatePatternEmptyKeysAndTopNotSlash()
    {
        $pattern = Yaml::createPattern(
            array(),
            new Phalcon\Config(array(
                "url" => "member/update"
            ))
        );
        $this->assertEquals("/member/update", $pattern);
    }

    /**
     * createMethod case empty keys and end slash
     */
    public function testCreatePatternEmptyKeysAndEndSlash()
    {
        $pattern = Yaml::createPattern(
            array(),
            new Phalcon\Config(array(
                "url" => "/member/update/"
            ))
        );
        $this->assertEquals("/member/update", $pattern);
    }

    /**
     * createMethod case array
     */
    public function testCreateMethodCaseArray()
    {
        $method = Yaml::createMethod(
            new Phalcon\Config(array(
                "method" => array(
                    "GET", "POST"
                )
            )
        ));

        $this->assertEquals("GET",  $method[0]);
        $this->assertEquals("POST", $method[1]);
    }

    /**
     * createMethod case string
     */
    public function testCreateMethodCaseString()
    {
        $method = Yaml::createMethod(
            new Phalcon\Config(array(
                "method" => "PUT"
            )
        ));
        $this->assertEquals("PUT", $method);
    }

    /**
     * createMethod case empty
     */
    public function testCreateMethodCaseEmpty()
    {
        $method = Yaml::createMethod();
        $this->assertEquals("GET", $method);
    }

    /**
     * createPaths case normal
     */
    public function testCreatePaths()
    {
        $paths = Yaml::createPaths(
            new Phalcon\Config(array("mypage", "index")),
                new Phalcon\Config(array(
                "namespace" => "Test\\Case",
                "controller" => "quest",
                "action" => "list",
                "module" => "api"
            ))
        );

        $this->assertEquals("quest",      $paths["controller"]);
        $this->assertEquals("list",       $paths["action"]);
        $this->assertEquals("Test\\Case", $paths["namespace"]);
        $this->assertEquals("api",        $paths["module"]);
    }

    /**
     * createPaths case empty paths
     */
    public function testCreatePathsEmptyPaths()
    {
        $paths = Yaml::createPaths(
            new Phalcon\Config(array("farm", "edit")),
            new Phalcon\Config(array())
        );

        $this->assertEquals("farm", $paths["controller"]);
        $this->assertEquals("edit", $paths["action"]);
    }

    /**
     * createPaths case empty paths and pairs singular
     */
    public function testCreatePathsEmptyPathsAndPairsSingular()
    {
        $paths = Yaml::createPaths(
            new Phalcon\Config(array("mypage")),
            new Phalcon\Config(array())
        );

        $this->assertEquals("mypage", $paths["controller"]);
        $this->assertEquals("index",  $paths["action"]);
    }
}
