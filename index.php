<pre>
<?php
    echo exec( 'whoami' );
    echo "\n";
    echo exec( 'id' );
    echo "\n";
    echo exec( 'pwd' );
    echo "\n";
    echo exec( 'ls -al' );
    echo exec( 'whoami > ./test.txt' );
    echo "\n";
    include( './test.txt' );
?>
</pre>