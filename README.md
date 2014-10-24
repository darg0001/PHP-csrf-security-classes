#CSRF security class
============

This is a lightweight security class that protects users from CSRF attacks. it works with sessions but I'm considering to use files in a later version.

#Documentation
============

###Create a token.
```
<?php
$security = new \security\CSRF;
$security->set(3, /* multiplier */, 3600); //3 * 3600 = 3 hours.
```

###Get a token.
```
<?php
$security = new \security\CSRF;
$token = $security->set(3, 3600);

echo $token;
```


###Get the last created token.
```
<?php
$security = new \security\CSRF;
$token = $security->last();

echo $token;
```


###Delete a token.
```
<?php
$security = new \security\CSRF;
$token = $security->set(3, /* multiplier */, 3600);

$security->delete($token);
```