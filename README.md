# PhalconRouter

Phalcon Routering for Yaml

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
# min
mypage_index: # /mypage/index

# max
mypage_index:
  module:     frontend # Default app/controllers/*
  method:     [ GET, POST ] # Default GER
  url:        /mypage/index/{user_id}
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


