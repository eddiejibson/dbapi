<?php
include_once "db.class.php";

//Get query will return the result e.g information about a user.
$res = $db->getQuery("SELECT item FROM someTable WHERE something = :something", ["something" => $something]);
if ($res) {
    foreach ($res as $res) {
        echo $res->item; //Do something with the result.
    }
}

//Run query will simply execute the statement. If it is a success, it will return true.
$res = $db->runQuery("INSERT INTO someTable(item) VALUES (:item)", ["item" => $item]);
if ($res) { //Do something with the result
    echo "Inserted Successfully!"; //The query has completed
} else {
    echo "Couldn't insert :("; //The query didn't complete
}
