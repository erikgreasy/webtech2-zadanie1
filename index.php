<?php

    define( "BASE_URL", 'http://localhost/webtech/zadanie1/' );
    date_default_timezone_set('Europe/Bratislava');


    if( isset( $_GET[ 'folder' ] ) && $_GET['folder'] != 'files' ) {
        $folder = rtrim( $_GET[ 'folder' ], '/' ) . '/';
    } else {
        $folder = 'files/';
    }

    $files = scandir( $folder );

    $files_arr = [];
    foreach( $files as $file ) {
        if( $file == '.' ) {
            continue;
        }

        
        $single_file = [];
        $single_file['name'] = $file;
        $single_file['size'] = filesize( $folder.$file );
        $single_file['date'] = filectime( $folder.$file );
        
        
        if( $file == '..' ) {
            $single_file['size'] = 0;
            $single_file['date'] = 0;
        }
        
        $files_arr[] = $single_file;
    }


    if( isset( $_GET[ 'order' ] ) ) {
        $order = $_GET[ 'order' ];
        switch($order) {
            case 'name':
                sort( $files );
                break;
            case 'size':
                usort( $files_arr, function($a, $b) {
                    if( $a['size'] == $b['size'] ) {
                        return 0;
                    }
            
                    return ($a['size'] < $b['size']) ? -1 : 1;
                } );
                break;
            case 'date':
                usort( $files_arr, function($a, $b) {
                    if( $a['date'] == $b['date'] ) {
                        return 0;
                    }
            
                    return ($a['date'] < $b['date']) ? -1 : 1;
                } );
                break;
                break;
        } 
    }
    
    // echo '<pre>';
    // var_dump( $files_arr );
    // echo '</pre>';
?>

<?php require_once 'header.php' ?>
  

    <main id="home" class="py-5">
        <div class="container">
            <div class="mb-4">
                <a href="upload.php">Upload new file</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th id="name-th">
                            <form action="" method="GET">
                                <input type="hidden" name="folder" value="<?= $folder ?>">
                                <input type="hidden" name="order" value="name">
                                <input type="submit" value="Meno">
                            </form>
                        </th>
                        <th id="size-th">
                            <form action="" method="GET">
                                <input type="hidden" name="folder" value="<?= $folder ?>">
                                <input type="hidden" name="order" value="size">
                                <input type="submit" value="Veľkosť">
                            </form>
                        </th>
                        <th id="date-th">
                            <form action="" method="GET">
                                <input type="hidden" name="folder" value="<?= $folder ?>">
                                <input type="hidden" name="order" value="date">
                                <input type="submit" value="Dátum">
                            </form>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach( $files_arr as $file ): ?>
                        <?php if( $file['name'] == '..' ): ?>
                            <?php if( $folder != 'files/' ): ?>
                                <tr class="table-row">
                                    <td class="name">
                                        <form action="" method="GET">
                                            <input type="hidden" name="folder" id=".." value="<?= dirname( $folder, 1 ) ?>">
                                            <input type="submit" value="<?= $file['name'] ?>">
                                        </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr class="table-row">
                                <?php if( is_dir( $folder . $file['name'] ) ): ?>
                                    <td class="name">
                                        <form action="" method="GET">
                                            <input type="hidden" name="folder" id="<?= $file ?>" value="<?= $folder . $file['name'] ?>">
                                            <input type="submit" value="<?= $file['name'] ?>">
                                        </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                <?php else: ?>
                                    <td class="name">
                                        <?= $file['name'] ?>
                                    </td>
                                    <td class="size"><?= $file['size'] ?></td>
                                    <td><?= date( 'd.m.Y H:i:s',  $file['date'] ) ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </main>
<?php require_once 'footer.php' ?>