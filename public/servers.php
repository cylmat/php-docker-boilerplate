<?php

$server = $_SERVER['SERVER_SOFTWARE'];
try {
    $pdo = new PDO("mysql:host=mysql;port=3306;dbname=mydb", 'user', 'pass');
    echo $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);
    $mysql = true;
} catch (Throwable $exception) {
    $mysql = false;echo $exception->getMessage();
}

return '<ul>'.
    "<li>$server</li>".
    $mysql ? '<li><span class="green">Mysql</span></li>' : '<span class="red">No mysql</span>'.
'</ul>';