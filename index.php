<pre>
<?= exec( 'whoami' ); ?>

<?= exec( 'id' ); ?>
    
<?= exec( 'pwd' ); ?>

<?= exec( 'ls -al' ); ?>
<?= exec( 'whoami > ./test.txt' ); ?>

<?php include( './test.txt' ); ?>
</pre>