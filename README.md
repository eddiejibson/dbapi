![DBAPI](https://media.giphy.com/media/oFyd7yendzmTO89MqI/giphy.gif)

Secure and easy PHP database API. Requires less code to execute a simple query.
- [Example usage](https://gitlab.com/eddiejibson/dbapi/blob/master/example.php)
## Enable the PDO driver
As this database API uses PDO, it must be enabled first. To do so, comment out the following within your `php.ini` file.
So that's uncommenting

    ;extension=php_pdo_mysql.dll

To

    extension=php_pdo_mysql.dll
## Security
This API takes advantage of prepared statements. This can prevent nasty attacks such as SQL injections. A demonstration of how to use such can be found within the [example](https://gitlab.com/eddiejibson/dbapi/blob/master/example.php)
