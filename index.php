<?php

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

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/app.css">


    <title>Zadanie 1 | Erik Masny</title>
</head>
<body>
  

    <main class="py-5">
        <div class="container">
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
                                    <td><?= date( 'd.m.Y H:m:s',  $file['date'] ) ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>