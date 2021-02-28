<?php

    require_once 'inc/config.inc.php';

    if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        // Array of error to display to user
        $errors = [];
        
        // Error on file
        if( isset( $_FILES['file']['error'] ) && $_FILES['file']['error'] ) {
            $errors[] = 'Subor je povinna polozka';
        }

        // Error on name input
        if( trim( $_POST['name'] ) == '' ) {
            $errors[] = 'Meno suboru je povinna polozka';
        }

        // We got no errors, process request
        if( empty( $errors ) ) {
            $target_dir = 'files/';

            $name_arr = explode( '.', $_FILES['file']['name'] );
            $extension = array_pop( $name_arr );

            // If file exists, add current timestamp to its name
            if( file_exists( $target_dir . $_POST[ 'name' ] . '.' . $extension ) ) {
                $file_name = $_POST[ 'name' ] . time() . '.' . $extension;
            } else {
                $file_name = $_POST[ 'name' ] . '.' . $extension;
            }

            $target_file = $target_dir . $file_name;

            // Upload file to destination
            move_uploaded_file($_FILES['file']['tmp_name'], $target_file );
            
            // Redirect user to homepage
            header( 'Location: ' . BASE_URL );
            exit;
        }

        
    }
?>

<?php require_once 'header.php' ?>
  

<main id="upload" class="py-5">
    <div class="container">
        <h1 class="mb-4" enc>Nahrajte svoj súbor</h1>

        <?php include_once 'partials/upload-form.php' ?>

    </div>

</main>

<?php require_once 'footer.php' ?>