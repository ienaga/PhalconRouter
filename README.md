# PhalconRouter

Phalcon Routering for Yaml

## Composer

```js
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
        new Phalcon\Config\Adapter\Yaml("path/route.yml")
    );
}, true);
```


