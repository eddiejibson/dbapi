Secure and easy PHP database API. Requires less code to execute a query and does so securely!

-  [Follow me on Twitter](https://twitter.com/eddiejibson/)

## Example

```php
<?php
require_once("db.class.php");
$db = new DB("hostname", "database name", "username (if applicable)", "password (if applicable)"); //Connect to the database with your credentials

//Get query will return the result e.g information about a user.
$res = $db->get("SELECT * FROM someTable WHERE something = :something", ["something" => $something]);
if ($res) {
    foreach ($res as $res) {
        echo $res->item; //Do something with the result.
    }
}

//If you only want you get one entry (object) instead of multiple, getOne() is here to help :)
$res = $db->get("SELECT item FROM someTable WHERE something = :something", ["something" => $something]);
echo "Here's the item I wanted to get!" . $res->item;

//Run query will simply execute the statement. If it is a success, it will return true.
$res = $db->run("INSERT INTO someTable(item) VALUES (:item)", ["item" => $item]);
if ($res) { //Do something with the result
    echo "Inserted Successfully!"; //The query has completed
} else {
    echo "Couldn't insert :("; //The query didn't complete
}
```

## Enable the PDO driver

As this database API uses PDO, it must be enabled first. To do so, comment out (remove the proceeding `;` infront) the following within your `php.ini` file.

So that's uncommenting

`;extension=php_pdo_mysql.dll`

To

`extension=php_pdo_mysql.dll`

## Security

This API takes advantage of prepared statements. This can prevent nasty attacks such as SQL injections. A demonstration of how to use such can be found within the [example](https://gitlab.com/eddiejibson/dbapi/blob/master/example.php)
