# ***dbapi***
Secure and easy PHP database API. Requires less codeto execute a simple query.
- [Example usage](https://gitlab.com/eddiejibson/dbapi/blob/master/example.php)
## Enable the PDO driver
As this database API uses PDO, it must be enabled first. To do so, comment out the following within your `php.ini` file.
So that's uncommenting

    ;extension=php_pdo_mysql.dll

To

    extension=php_pdo_mysql.dll

