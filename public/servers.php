<?php

try {
    $maria = new PDO(getenv('MARIADB_DSN'), 'user', 'pass');
    $maria_version = $maria->getAttribute(\PDO::ATTR_SERVER_VERSION);
} catch (Throwable $exception) {
    $maria = false;
    echo $exception->getMessage();
}

try {
    $mysql = new PDO(getenv('MYSQL_PORT'), 'user', 'pass');
    $mysql_version = $mysql->getAttribute(\PDO::ATTR_SERVER_VERSION);
} catch (Throwable $exception) {
    $mysql = false;
    echo $exception->getMessage();
}

$template = '<style>.green{color:green} .red{color:red}</style>'.'<ul>'.
    "<li>{$_SERVER['SERVER_SOFTWARE']}</li>".
    "<li>PHP ".PHP_VERSION."</li>".
    ($maria
        ? "<li><span class=\"green\">MariaDb v$maria_version</span></li>"
        : '<li><span class="red">No MariaDb</span></li>').
    ($mysql
        ? "<li><span class=\"green\">Mysql v$mysql_version</span></li>"
        : '<li><span class="red">No Mysql</span></li>').
'</ul>';

return $template;