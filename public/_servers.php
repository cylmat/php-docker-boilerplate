<?php

# Use 'docker exec phpfpm "curl apache:80"' to test servers

$server = ucfirst($_SERVER['SERVER_SOFTWARE']);
$php = "PHP ".PHP_VERSION;

$errors = 
$maria_version = 
$mysql_version = '';

try {
    $maria_version = 
        (new PDO(getenv('MARIADB_DSN'), 'user', 'pass'))
            ->getAttribute(PDO::ATTR_SERVER_VERSION);

    $mysql_version = "Mysql v".
        (new PDO(getenv('MYSQL_DSN'), 'user', 'pass'))
            ->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (Throwable $exception) {
    $errors .= $exception->getMessage()."\n";
}

// Cli check
$cli = "
$server
$php
$maria_version
$mysql_version
\n";

// Html
$template = '<style>.green{color:green} .red{color:red}</style>'.
'<h1>It works</h1>'.
'<ul>'.
    "<li>$server</li>".
    "<li>$php</li>".
    ($maria_version
        ? "<li><span class=\"green\">$maria_version</span></li>"
        : '<li><span class="red">No MariaDb</span></li>').
    ($mysql_version
        ? "<li><span class=\"green\">$mysql_version</span></li>"
        : '<li><span class="red">No Mysql</span></li>').
'</ul>';

if ('' !== $errors) return $errors.PHP_EOL;
return key_exists('check', $_GET) ? $cli : $template;
