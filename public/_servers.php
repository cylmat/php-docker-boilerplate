<?php

# Use 'docker exec phpfpm "curl apache:80"' to test servers

$server = ucfirst($_SERVER['SERVER_SOFTWARE']);
$php = "PHP ".PHP_VERSION;

$isCheck = key_exists('check', $_GET);

$errors = 
$maria_version = 
$mysql_version = '';

try {
    $maria_version = 
        (new PDO(getenv('MARIADB_DSN'), 'user', 'pass'))
            ->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (Throwable $exception) {
    $errors .= $exception->getMessage()."\n";
}

try {
    $mysql_version = "Mysql ".
        (new PDO(getenv('MYSQL_DSN'), 'user', 'pass'))
            ->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (Throwable $exception) {
    $errors .= $exception->getMessage()."\n";
}

// Check CLI
$check = "
$server
$php
$maria_version
$mysql_version
$errors
\n";

// Html
$template = '<style>.green{color:green} .red{color:red}</style>'.
'<h1>It works</h1>'.
'<ul>'.
    "<li>$server</li>".
    "<li>$php</li>".
    ($maria_version
        ? "<li><span class=\"green\">MariaDb v$maria_version</span></li>"
        : '<li><span class="red">No MariaDb</span></li>').
    ($mysql_version
        ? "<li><span class=\"green\">Mysql v$mysql_version</span></li>"
        : '<li><span class="red">No Mysql</span></li>').
'</ul>'.nl2br($errors).'<br/>';

$ext = get_loaded_extensions();
sort($ext, SORT_FLAG_CASE|SORT_NATURAL);

return ($isCheck ? $check : $template)  . join(', ', $ext);
