<?php
    require_once( './password.php' );
?>
<html>
    <head>
        <title>Anton's workspace</title>
        <style>
body, input, select, option {
    font-family: 'Lucida console';
    background: #090808;
    color: #0f0;
}

.upper {
    position: fixed;
    top: 20px;
    left: 20px;
    right: 20px;
    bottom: 60px;
    overflow: auto;
}

.lower {
    position: fixed;
    bottom: 20px;
    left: 20px;
    right: 20px;
}
        </style>
    </head>
    <body>
    <?php
        if ( $_POST['password'] != $password ) {
        ?>
            <form method="post" action="./" class="lower">
                Password: <input type="password" name="password" />
                <input type="submit" value="Log in" />
            </form>
        <?php
        } else {
        ?>
            <pre class="upper">
<?php
    if ( $_POST['newDomain'] != "" ) {
        echo 'Generating file...';
        flush();
        echo passthru( '/opt/theharvester/theHarvester.py -d ' . $_POST['newDomain'] . ' -b all -l 500 -h > ./files/' . $_POST['newDomain'] );
        echo "\n".'Done';
        $_POST['generatedDomain'] = $_POST['newDomain'];
        echo "\n\n";
    }
    
    if ( $_POST['generatedDomain'] != "" ) {
        if ( $_POST['grep'] != "" ) {
            echo passthru( 'cat ./files/' . $_POST['generatedDomain'] . ' | grep ' . $_POST['grep'] );
        } else {
            echo passthru( 'cat ./files/' . $_POST['generatedDomain'] );
        }
    } else {
        echo passthru( '/opt/theharvester/theHarvester.py' );
    }
?>
            </pre>
            <form method="post" action="./" class="lower">
                <input type="hidden" name="password" value="<?=$_POST['password']?>" />
                New domain: <input name="newDomain" />
                Generated domain:
                    <select name="generatedDomain">
                        <?php
                            $foundGeneratedDomain = false;
                            $dir = new DirectoryIterator( dirname( './files/*' ) );
                            foreach ( $dir as $fileInfo ) {
                                if ( !$fileInfo->isDot() ) {
                                    ?>
                                        <option value="<?= $fileInfo->getFilename(); ?>"
                                            <?php
                                                if ( $fileInfo->getFilename() == $_POST['generatedDomain'] ) {
                                                    echo 'selected';
                                                    $foundGeneratedDomain = true;
                                                }
                                            ?>
                                        ><?= $fileInfo->getFilename(); ?></option>
                                    <?php
                                }
                            }
                        ?>
                        <option value="" <?php if ( !$foundGeneratedDomain ) { echo "selected"; } ?>>None</option>
                    </select>
                Grep: <input name="grep" value="<?= $_POST['grep'] ?>" />
                <input type="submit" value="Enter" />
            </form>
        <?php
        }
        ?>
    </body>
</html>