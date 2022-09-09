<?php

echo '<html><body>'. 
        '<h1>It works with PHP '.PHP_VERSION.' with :</h1>'.
        (include __DIR__.'/servers.php').
    '</body></html>'
;
