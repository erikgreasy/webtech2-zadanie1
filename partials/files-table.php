<table class="table">
    <thead>
        <tr>
            <th id="name-th">
                <form action="#" method="GET">
                    <input type="hidden" name="folder" value="<?= $folder ?>">
                    <input type="hidden" name="order" value="name">
                    <input type="submit" value="Meno">
                </form>
            </th>
            <th id="size-th">
                <form action="#" method="GET">
                    <input type="hidden" name="folder" value="<?= $folder ?>">
                    <input type="hidden" name="order" value="size">
                    <input type="submit" value="Veľkosť">
                </form>
            </th>
            <th id="date-th">
                <form action="#" method="GET">
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