# Phalcon Routering for Yaml

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

```yaml
mypage_index:
  method:     [ GET, POST ]
  url:        /mypage/index/{user_id}
  controller: mypage
  action:     index
  namespace:  \Name\Space
  
```

## app/config/services.php

```php
$di->set('router', function()
{
    return new \PhalconRouter\Yaml::load(
        new Phalcon\Config\Adapter\Yaml("path/routing.yml")
    );
}, true);
```


