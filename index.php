<?php

    if( isset( $_GET[ 'folder' ] ) && $_GET['folder'] != 'files' ) {
        $folder = $_GET[ 'folder' ] . '/';
    } else {
        $folder = 'files/';
    }
    $files = scandir( $folder );

    // echo '<pre>';
    // var_dump( $files );
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
  

    <main>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th id="name-th">Meno</th>
                        <th id="size-th">Veľkosť</th>
                        <th id="date-th">Dátum</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach( $files as $file ): ?>
                        <?php if( $file != '.' ): ?> 
                            <?php if( $file == '..' ): ?>
                                <?php if( $folder != 'files/' ): ?>
                                    <tr class="table-row">
                                        <td class="name">
                                            <form action="" method="GET">
                                                <input type="hidden" name="folder" id=".." value="<?= dirname( $folder, 1 ) ?>">
                                                <input type="submit" value="<?= $file ?>">
                                            </form>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            <?php else: ?>
                                <tr class="table-row">
                                    <?php if( is_dir( $folder . $file ) ): ?>
                                        <td class="name">
                                            <form action="" method="GET">
                                                <input type="hidden" name="folder" id="<?= $file ?>" value="<?= $folder . $file ?>">
                                                <input type="submit" value="<?= $file ?>">
                                            </form>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    <?php else: ?>
                                        <td class="name">
                                            <?= $file ?>
                                        </td>
                                        <td class="size"><?= filesize( $folder.$file ) ?></td>
                                        <td><?= date( 'd.m.Y',  filectime( $folder.$file ) ) ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
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