<?php

    require_once 'inc/config.inc.php';

    if( isset( $_GET[ 'folder' ] ) && $_GET['folder'] != 'files' ) {
        $folder = rtrim( $_GET[ 'folder' ], '/' ) . '/';
    } else {
        $folder = 'files/';
    }

    $files = scandir( $folder );
    $files_arr = create_files_array( $folder, $files );

    if( isset( $_GET[ 'order' ] ) ) {
        $order = $_GET[ 'order' ];
        switch($order) {
            case 'name':
                sort( $files );
                break;
            case 'size':
                $files_arr = sort_array_by_size( $files_arr );
                break;
            case 'date':
                $files_arr = sort_array_by_date( $files_arr );
                break;
        } 
    }
    
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