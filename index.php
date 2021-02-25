<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <title>Zadanie 1 | Erik Masny</title>
</head>
<body>
  

    <main>
        <div class="container">
            <?php

                $files = scandir('files');
                

            ?>

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
                        <?php if( $file != '.' && $file != '..' ): ?>
                            <tr class="table-row">
                                <td class="name"><?= $file ?></td>
                                <td class="size"><?= filesize( 'files/'.$file ) ?></td>
                                <td><?= date( 'd.m.Y',  filectime( 'files/'.$file ) ) ?></td>
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