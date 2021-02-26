<?php
    define( "BASE_URL", 'http://localhost/webtech/zadanie1/' );

    if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

        $errors = [];
        // print_r( $_POST );
        // die();
        if( isset( $_FILES['file']['error'] ) ) {
            $errors['file'] = 'Subor je povinna polozka';
        }

        if( trim( $_POST['name'] ) == '' ) {
            $errors['name'] = 'Meno suboru je povinne';
        }

        // print_r( $errors );
        // die();

        if( empty( $errors ) ) {
            $target_dir = 'files/';
            $target_file = $target_dir . $_FILES['file']['name'];

            move_uploaded_file($_FILES['file']['tmp_name'], $target_file );
            
            header( 'Location: ' . BASE_URL );
            exit;
        }

        
    }
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
  

    <main id="upload" class="py-5">
        <div class="container">
            <h1 class="mb-4" enc>Nahrajte svoj súbor</h1>

            <?php if( !empty( $errors ) ): ?>

                <?php print_r( $errors ) ?>

            <?php endif; ?>

            <form action="" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="name">
                        Názov súboru:
                        <input type="text" name="name" id="name" class="form-control">
                    </label>
                </div>

                <div class="form-group">
                    <label for="file">
                        <input type="file" name="file" id="file">
                    </label>
                </div>

                <input type="submit" value="Nahrať" class="btn btn-info">
            </form>
        </div>

    </main>

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>