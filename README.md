Social feed widgets for Yii 2
=========

Installation   
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2mod/feed "*"
```

or add

```json
"yii2mod/feed": "*"
```

to the require section of your composer.json.

Twitter 
=================
Configuration:
-----------------

```php
    //set keys at the beginning of config
    \Yii::$container->set('yii2mod\feed\Twitter', [
        'token' => '',
        'tokenSecret' => '',
        'consumerKey' => '',
        'consumerSecret' => '',
    ]);

```

Usage:
----------------
```php
    <?php echo yii2mod\feed\Twitter::widget(['screenName' => 'disem', 'postsCount' => 3]); ?>
```

RSS
=================
Allows to display multiple rss feeds as one
Usage:
----------------
```php
<?php echo yii2mod\feed\Rss::widget(['to' => 3, 'feeds' => [
'http://somerss.com/rss.xml',
'http://somerss.com/rss2.xml',
]]); ?>
```