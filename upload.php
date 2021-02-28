<?php
    define( "BASE_URL", 'http://localhost/webtech/zadanie1/' );

    if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        $errors = [];
        
        if( isset( $_FILES['file']['error'] ) && $_FILES['file']['error'] ) {
            $errors[] = 'Subor je povinna polozka';
        }

        if( trim( $_POST['name'] ) == '' ) {
            $errors[] = 'Meno suboru je povinna polozka';
        }

        // print_r( explode( '.', $_FILES['file']['name'] ) );
        // die();

        if( empty( $errors ) ) {
            $target_dir = 'files/';

            $name_arr = explode( '.', $_FILES['file']['name'] );
            $extension = array_pop( $name_arr );

            if( file_exists( $target_dir . $_POST[ 'name' ] . '.' . $extension ) ) {
                $file_name = $_POST[ 'name' ] . time() . '.' . $extension;
                // die( $file_name );
            } else {
                // die($_POST[ 'name' ] . '.' . $extension);

                $file_name = $_POST[ 'name' ] . '.' . $extension;
            }

            $target_file = $target_dir . $file_name;

            move_uploaded_file($_FILES['file']['tmp_name'], $target_file );
            
            header( 'Location: ' . BASE_URL );
            exit;
        }

        
    }
?>

<?php require_once 'header.php' ?>
  

    <main id="upload" class="py-5">
        <div class="container">
            <h1 class="mb-4" enc>Nahrajte svoj súbor</h1>

            <?php if( !empty( $errors ) ): ?>

                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach( $errors as $error ): ?>
                            <li>
                                <?= $error ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php endif; ?>

            <form action="" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="name">
                        Názov súboru:
                        <input type="text" name="name" id="name" class="form-control" required>
                    </label>
                </div>

                <div class="form-group">
                    <label for="file">
                        <input type="file" name="file" id="file" required>
                    </label>
                </div>

                <input type="submit" value="Nahrať" class="btn btn-info">
            </form>
        </div>

    </main>

<?php require_once 'footer.php' ?>