# Phalcon Routering for Yaml

[![Build Status](https://travis-ci.org/ienaga/PhalconRouter.svg?branch=master)](https://travis-ci.org/ienaga/PhalconRouter)


[![Latest Stable Version](https://poser.pugx.org/ienaga/phalcon-router-for-yaml/v/stable)](https://packagist.org/packages/ienaga/phalcon-router-for-yaml) [![Total Downloads](https://poser.pugx.org/ienaga/phalcon-router-for-yaml/downloads)](https://packagist.org/packages/ienaga/phalcon-router-for-yaml) [![Latest Unstable Version](https://poser.pugx.org/ienaga/phalcon-router-for-yaml/v/unstable)](https://packagist.org/packages/ienaga/phalcon-router-for-yaml) [![License](https://poser.pugx.org/ienaga/phalcon-router-for-yaml/license)](https://packagist.org/packages/ienaga/phalcon-router-for-yaml)


## Composer

```json
{
    "require": {
       "ienaga/phalcon-router-for-yaml": "*"
    }
}
```


## routing.yml sample

### min

```yaml
mypage_index: # /mypage/index
```


### max

```yaml
mypage_index:
  module:     frontend # Default null
  method:     [ GET, POST ] # Default GET
  url:        /mypage/{user_id}
  controller: mypage
  action:     index
  namespace:  \Name\Space
```


## app/config/services.php

```php
$di->set('router', function () {
    return \PhalconRouter\Yaml::load(
        new \Phalcon\Config\Adapter\Yaml(APP_PATH ."/directory/routing.yml")
    );
}, true);
```


