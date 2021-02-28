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

        <?php include_once 'partials/files-table.php' ?>

    </div>

</main>

<?php require_once 'footer.php' ?>