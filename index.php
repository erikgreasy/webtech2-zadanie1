<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Zadanie 1 | Erik Masny</title>
</head>
<body>
  

    <main>

        <?php

            $files = scandir('files');
            

        ?>

        <table>
            <tr>
                <th>Meno</th>
                <th>Veľkosť</th>
                <th>Dátum</th>
            </tr>

            <?php foreach( $files as $file ): ?>
                <?php if( $file != '.' && $file != '..' ): ?>
                    <tr>
                        <td><?= $file ?></td>
                        <td><?= filesize( 'files/'.$file ) ?></td>
                        <td><?= date( 'd.m.Y',  filectime( 'files/'.$file ) ) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>

    </main>

</body>
</html>